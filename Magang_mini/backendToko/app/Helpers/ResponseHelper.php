<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function success(mixed $data = null, string $message = 'Berhasil.', int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public static function error(string $message = 'Terjasi kesalahn.',
        int $statusCode = 400,
        mixed $errors = null): JsonResponse{
            $body = ['status' => false, 'message' => $message];
            if ($errors !== null){
                $body['errors'] = $errors;
            }
            return response()->json($body, $statusCode);
    }

    public static function paginate($data, string $message = 'Data berhasil diambil.')
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data->items(),
            'pagination' => [
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'last_page' => $data->lastPage(),
            ]
        ]);
    }

}
