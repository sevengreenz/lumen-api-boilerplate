<?php

namespace App\Adapters\Http\Requests\Sample;

use Illuminate\Http\Request;
use App\Adapters\Http\Requests\AbstractRequest;

class CreateRequest extends AbstractRequest
{
    protected $request;

    protected $validationRule = [
        'title'   => 'required:string',
        'is_done' => 'boolean',
    ];
}
