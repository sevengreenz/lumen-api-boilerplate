<?php

namespace App\Adapters\Http\Responses\Sample;

use App\UseCases\Contracts\OutputPortInterface;

class ListResponse implements OutputPortInterface
{
    /**
     * list up sample API response
     *
     * @param array $result
     *
     * @return view
     */
    public function success(array $result)
    {
        $hal = [
            '_links' => [
                'self' => [
                    'href' => sprintf('/samples')
                ]
            ]
        ];
        return response($result + $hal, 200);
    }
}
