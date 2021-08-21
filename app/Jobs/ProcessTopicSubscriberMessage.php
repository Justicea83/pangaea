<?php

namespace App\Jobs;

use App\Models\Subscription;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessTopicSubscriberMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    private Subscription $subscription;
    private array $payload;
    public function __construct(Subscription $subscription,array $payload)
    {
        $this->subscription = $subscription;
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client(['verify' => false]);

        try {
            $response = $client->request('POST', $this->subscription->url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'json' => $this->payload
            ]);

            $status = $response->getStatusCode();

            Log::info(get_class(),['status' => $status]);
        } catch (GuzzleException $e) {
            Log::critical(get_class(),['message' => $e->getMessage()]);
        }
    }
}
