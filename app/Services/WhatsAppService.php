<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    public function send(string $to, string $message): void
    {
        $to = trim($to);
        if ($to === '') {
            return;
        }

        $url = config('services.whatsapp.url');
        $token = config('services.whatsapp.token');

        // If no provider configured, fall back to log so it's still observable in dev.
        if (!$url) {
            Log::info('[WA][dummy] send', ['to' => $to, 'message' => $message]);
            return;
        }

        $headers = [];
        if ($token) {
            $headers['Authorization'] = 'Bearer ' . $token;
        }

        Http::withHeaders($headers)
            ->timeout(10)
            ->post($url, [
                'to' => $to,
                'message' => $message,
            ]);
    }
}
