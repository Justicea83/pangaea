<?php

namespace App\Services\Topics;

interface TopicsServiceContract
{
    public function subscribeToTopic(string $topicName,array $payload):array;
    public function publishToTopic(string $topicName,array $data);
}
