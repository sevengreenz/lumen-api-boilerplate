<?php

namespace App\Adapters\Gateways;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface GatewayException
{
};

class NotFoundException extends \Exception implements GatewayException
{
    protected const STATUS_CODE = '404';

    protected $table;
    protected $where;

    public function __construct(string $table, array $where)
    {
        $this->table = $table;
        $this->where = $where;

        parent::__construct('Not Found');
    }

    public function report(): void
    {
        app('log')->error(
            $this->getMessage(),
            [
                'table' => $this->table,
                'where' => $this->where
            ]
        );
    }

    public function render(Request $request): JsonResponse
    {
        $body = [
            'message' => $this->getMessage(),
        ];

        return response()->json($body, static::STATUS_CODE);
    }
}
