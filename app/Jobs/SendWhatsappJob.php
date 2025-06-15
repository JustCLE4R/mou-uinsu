<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWhatsappJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $phone;
    protected string $message;

    public function __construct(string $phone, string $message)
    {
        $this->phone = $phone;
        $this->message = $message;
    }

    public function handle(): void
    {
        try {
            $response = Http::post(env('WA_GATEWAY'), [
                'number' => $this->phone,
                'message' => $this->message,
            ]);

            if (!$response->successful()) {
                Log::error('WA Gateway failed: ' . $response->body(), [
                    'number' => $this->phone,
                    'message' => $this->message,
                ]);
            } else {
                // Log::info('WA sent: ' . $this->phone);
            }
        } catch (\Throwable $e) {
            Log::error('WA Gateway exception: ' . $e->getMessage(), [
                'number' => $this->phone,
                'message' => $this->message,
            ]);

            // Laravel will auto retry based on config
            throw $e;
        }
    }
}
