<?php

if (!function_exists('api_success')) {
    function api_success($data, $message = '', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}

if (!function_exists('api_error')) {
    function api_error($message = '', $statusCode = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $statusCode);
    }
}
