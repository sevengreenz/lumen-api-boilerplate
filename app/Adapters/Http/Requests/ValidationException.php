<?php

namespace App\Adapters\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ValidationException extends \Exception
{
    protected $validator;

    public function __construct(Validator $validator)
    {
        parent::__construct('Unprocessable Entity');

        $this->validator = $validator;
    }

    public function report(): void
    {
        app('log')->error(
            $this->message,
            [
                'params' => $this->validator->getData(),
                'errors' => $this->validator->errors()->all()
            ]
        );
    }

    public function render(Request $request): JsonResponse
    {
        $body = [
            'message' => $this->getMessage(),
            'errors'  => $this->validator->errors()
        ];

        return response()->json($body, 422);
    }
}
