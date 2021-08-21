<?php

namespace App\Providers;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TopicMessagePublished
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $topic;
    public array $payload;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $topic,array $payload)
    {
        $this->topic = $topic;
        $this->payload = $payload;
    }


}
