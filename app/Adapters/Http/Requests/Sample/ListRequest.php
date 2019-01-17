<?php
namespace App\Adapters\Http\Requests\Sample;

use Illuminate\Http\Request;
use App\Adapters\Http\Requests\AbstractRequest;

class ListRequest extends AbstractRequest
{
    protected $request;

    protected $validationRule = [
        '_sort'    => 'string',
        '_order'   => 'string',
    ];
}
