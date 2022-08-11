<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponser
{
    /**
     * Return json response with success data
     *
     * @param array|string $data
     * @param int|null $code
     * @return JsonResponse
     */
    protected function success($data, int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], $code);
    }

    /**
     * Return json response with error data
     *
     * @param string $message
     * @param int $code
     * @param array|string|null $data
     * @return JsonResponse
     */
    protected function error(string $message, int $code, $data = null): JsonResponse
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => $data
        ], $code);
    }

}
