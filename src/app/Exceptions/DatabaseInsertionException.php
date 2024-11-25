<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;

class DatabaseInsertionException extends Exception
{
    public function report(): bool
    {
        return false;
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(): RedirectResponse
    {
        return redirect()->route("home");
    }
}
