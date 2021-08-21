<?php

namespace App\Providers;

use App\Jobs\ProcessTopicSubscriberMessage;
use App\Models\Subscription;
use App\Models\Topic;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTopicSubscriberNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param TopicMessagePublished $event
     * @return void
     */
    public function handle(TopicMessagePublished $event)
    {
        /** @var Topic $topic */
        $topic = Topic::query()->with(['subscriptions'])->where('name', $event->topic)->first();

        /** @var Subscription $subscription */
        foreach ($topic->subscriptions as $subscription) {
            ProcessTopicSubscriberMessage::dispatch($subscription,$event->payload);
        }
    }


}
