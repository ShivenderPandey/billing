<?php

namespace App\Console\Commands;

use App\Models\MessageLog;
use App\Models\Website;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SendExpiryReminders extends Command
{
    // "php artisan billing:send-expiry-reminders"
    protected $signature = 'billing:send-expiry-reminders';

    protected $description = 'Send WhatsApp reminders for websites expiring in 14 days';

    public function handle()
    {
        $targetDate = now()->addDays(14)->toDateString();

        $websites = Website::with('user')
            ->whereDate('expiry_date', $targetDate)
            ->where('status', 'active')
            ->get();

        if ($websites->isEmpty()) {
            $this->info("No websites expiring in 14 days.");
            return 0;
        }

        $this->info("Found {$websites->count()} websites. Sending messages...");

        foreach ($websites as $website) {
            $user = $website->user;

            if (!$user || !$user->phone || !$user->whatsapp_opt_in) {
                continue;
            }

            $log = MessageLog::create([
                'website_id'    => $website->id,
                'user_id'       => $user->id,
                'provider'      => 'whatsapp_cloud',
                'template_name' => env('WHATSAPP_TEMPLATE_NAME'),
                'status'        => 'queued',
            ]);

            $response = $this->sendWhatsappTemplate($user->phone, $user->name, $website);

            if ($response['ok']) {
                $log->update([
                    'status'             => 'sent',
                    'provider_message_id'=> $response['message_id'] ?? null,
                    'response'           => $response['data'],
                ]);
            } else {
                $log->update([
                    'status'   => 'failed',
                    'response' => $response['data'],
                ]);
            }
        }

        return 0;
    }

    protected function sendWhatsappTemplate(string $phone, string $name, Website $website): array
    {
        $phoneId  = env('WHATSAPP_PHONE_NUMBER_ID');
        $token    = env('WHATSAPP_ACCESS_TOKEN');
        $template = env('WHATSAPP_TEMPLATE_NAME', 'billing_reminder_14d');
        $lang     = env('WHATSAPP_TEMPLATE_LANG', 'en_US');

        $expiry   = $website->expiry_date->format('Y-m-d');

        $payload = [
            'messaging_product' => 'whatsapp',
            'to'                => $phone,
            'type'              => 'template',
            'template' => [
                'name'    => $template,
                'language'=> ['code' => $lang],
                'components' => [
                    [
                        'type' => 'body',
                        'parameters' => [
                            ['type' => 'text', 'text' => $name],
                            ['type' => 'text', 'text' => $website->name],
                            ['type' => 'text', 'text' => $website->domain],
                            ['type' => 'text', 'text' => $expiry],
                        ],
                    ],
                ],
            ],
        ];

        try {
            $res = Http::withToken($token)
                ->post("https://graph.facebook.com/v21.0/{$phoneId}/messages", $payload);

            if ($res->successful()) {
                $body = $res->json();
                return [
                    'ok'         => true,
                    'data'       => $body,
                    'message_id' => $body['messages'][0]['id'] ?? null,
                ];
            }

            return ['ok' => false, 'data' => $res->json()];
        } catch (\Throwable $e) {
            return ['ok' => false, 'data' => $e->getMessage()];
        }
    }
}
