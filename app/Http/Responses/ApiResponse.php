<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use App\Enums\ApiResponseCode;

class ApiResponse implements Responsable
{
    protected $data;
    protected $message;
    protected $status;

    public function __construct($data = null, string $message = '', ApiResponseCode $status = ApiResponseCode::SUCCESS)
    {
        $this->data = $data;
        $this->message = $message;
        $this->status = $status;
    }

    public function toResponse($request): JsonResponse
    {
        $response = [
            'message' => $this->message,
        ];
        if (!is_null($this->data)) {
            $response['data'] = $this->data;
        }
        return response()->json($response, $this->status->value);
    }
}
