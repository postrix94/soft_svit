<?php

namespace App\Http\Controllers\Email;

use App\Events\SendEmailEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mail\EmailRequest;
use App\Modules\SentEmails\Services\SentEmailService;

class EmailController extends Controller
{
    public function send(EmailRequest $request, SentEmailService $sentEmailService)
    {
        $data = $request->only(["from", "to", "cc","subject","type_list","body_list"]);
        $data["ip"] = $request->ip();
        $data["user_agent"] = $request->userAgent();

        $email = $sentEmailService->save($data);
        SendEmailEvent::dispatch($email);

        return redirect()->route("success_sent", ["id" => $email->id]);
    }

    public function success(int $id, SentEmailService $sentEmailService) {
        return view("pages.email.success_sent", ["email" => $sentEmailService->findById($id)]);
    }
}
