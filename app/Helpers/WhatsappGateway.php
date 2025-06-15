<?php

namespace App\Helpers;

use App\Jobs\SendWhatsappJob;

class WhatsappGateway
{
    public static function send(string $phone, string $message): void
    {
        SendWhatsappJob::dispatch($phone, $message);
    }
}
