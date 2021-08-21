<?php

namespace App\Http\Controllers;

use App\Http\Requests\Topics\PublishToTopicRequest;
use App\Http\Requests\Topics\TopicSubscriptionRequest;
use App\Services\Topics\TopicsServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TopicsController extends Controller
{
    private TopicsServiceContract $service;

    function __construct(TopicsServiceContract $service)
    {
        $this->service = $service;
    }

    public function subscribeToTopic(string $topic,TopicSubscriptionRequest $request): JsonResponse
    {
        return $this->successResponse($this->service->subscribeToTopic($topic,$request->all()));
    }

    public function publishToTopic(string $topic,PublishToTopicRequest $request): Response
    {
        $this->service->publishToTopic($topic,$request->all());
        return $this->noContent();
    }
}
