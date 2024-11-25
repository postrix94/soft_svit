<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class RecordNotFoundException extends Exception
{
    public function report(): bool
    {
        return false;
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(): Response
    {
        return abort(404);
    }
}
