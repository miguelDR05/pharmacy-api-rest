<?php

if (!function_exists('responseApi')) {
    function responseApi(
        bool $success = true,
        string $message = '',
        string $title = '',
        mixed $data = null,
        array $extra = [],
        int $code = 200
    ) {
        return response()->json(array_merge([
            'success' => $success,
            'code' => $code,
            'title' => $title,
            'message' => $message,
            'data' => $data
        ], $extra), $code);
    }
}
