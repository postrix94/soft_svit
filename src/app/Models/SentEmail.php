<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SentEmail extends Model
{
    protected $fillable = [
        "uuid",
        "from",
        "to",
        "cc",
        "subject",
        "type",
        "body",
        "ip",
        "user_agent",
    ];
}
