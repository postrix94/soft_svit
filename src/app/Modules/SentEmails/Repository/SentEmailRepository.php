<?php

namespace App\Modules\SentEmails\Repository;

use App\Models\SentEmail;
use App\Modules\SentEmails\Repository\Contracts\SentEmailRepositoryContract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use  App\Modules\SentEmails\DTO\SentNewListDTO;

class SentEmailRepository implements SentEmailRepositoryContract
{
    /**
     * @return Builder
     */
    public function newQuery(): Builder
    {
        return SentEmail::query();
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): null|Model {
        $emailInfo = $this->newQuery()->where("id", $id)->first();
        return is_null($emailInfo) ? null : $emailInfo;
    }

    /**
     * @param SentNewListDTO $email
     * @return null|Model
     */
    public function create(SentNewListDTO $email): null|Model
    {
        try {
           $newEmail = $this->newQuery()->create([
                "uuid" => $email->uuid,
                "from" => $email->from,
                "to" => $email->to,
                "cc" => $email->cc,
                "subject" => $email->subject,
                "type" => $email->type,
                "body" => $email->body,
                "ip" => $email->ip,
                "user_agent" => $email->userAgent,

            ]);
        }catch (\Exception $e) {
            Log::error($e->getMessage() . ": " . Carbon::now());
            return false;
        }

        return $newEmail;
    }
}
