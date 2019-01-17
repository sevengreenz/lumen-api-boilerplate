<?php

namespace App\Adapters\Http\Responses\Sample;

use App\UseCases\Contracts\OutputPortInterface;

class CreateResponse implements OutputPortInterface
{
    /**
     * create sample API Response
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
                    'href' => sprintf('/samples/%s', $result['id'])
                ]
            ]
        ];
        return response($result + $hal, 201);
    }
}
