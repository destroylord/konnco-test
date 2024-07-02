<?php

namespace App\Traits;

trait JsonResponse
{
    public function jsonResponse(string $message, bool $isOk = true, int $code = 200)
    {
        return response()->json([
            'status' => $isOk,
            'message' => $message
        ], $code);
    }
}
