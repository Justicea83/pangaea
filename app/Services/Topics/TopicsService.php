<?php

namespace App\Services\Topics;

use App\Models\Topic;
use App\Providers\TopicMessagePublished;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class TopicsService implements TopicsServiceContract
{

    private Topic $topicModel;

    function __construct(Topic $topicModel)
    {
        $this->topicModel = $topicModel;
    }

    private function getTopicByName(string $name): Topic{
        /** @var Topic $topic */
        $topic = $this->topicModel->query()->where('name',$name)->first();

        //assuming this error is never thrown because of the validation
        if($topic == null) throw new ModelNotFoundException();

        return $topic;
    }

    public function subscribeToTopic(string $topicName, array $payload): array
    {
        $topic = $this->getTopicByName($topicName);

        try {
            $topic->subscriptions()->create([
                'url' => $payload['url']
            ]);
        }catch (QueryException $e){

        }

        return [
            'url' => $payload['url'],
            'topic' => $topicName
        ];
    }

    public function publishToTopic(string $topicName, array $data)
    {
        $topic = $this->getTopicByName($topicName);

        $topic->messages()->create([
            'payload' => json_encode($data)
        ]);

        TopicMessagePublished::dispatch($topicName,$data);
    }
}
