<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class WhatsAppController extends Controller
{
    /**
     * Kirim pesan WhatsApp.
     * Bisa dipanggil dari controller lain.
     */
    public function sendMessage($number, $message)
    {
        $apiKey = 'DoapL3e58i7xSyX8hYG22SuQNrVjB8';
        $url = 'https://wa.ahmadfadillah.my.id/send-message';
        $params = [
            'api_key' => $apiKey,
            'sender' => config('app.senderwhatsapp'),
            'number' => $number,
            'message' => $message,
        ];

        try {
            $response = Http::get($url, $params);

            if ($response->successful()) {
                return $response->json();
            } else {
                return [
                    'status' => 'error',
                    'message' => 'Gagal mengirim pesan',
                    'details' => $response->body()
                ];
            }
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghubungi API',
                'error' => $e->getMessage()
            ];
        }
    }
}
