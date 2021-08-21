<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{
    protected function successResponse(array $data, $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json($data, $code);
    }
    protected function errorResponse($message, $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    protected function noContent(): \Illuminate\Http\Response
    {
        return response()->noContent();
    }
}
