<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    public function sendResponse(mixed $result, string $message, int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'success'   => true,
            'data'      => $result,
            'message'   => $message,
        ], $code);
    }

    public function sendError(string $error, array $errors = [], int $code = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        $response = [
            'success'   => false,
            'message'   => $error,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}