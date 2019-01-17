<?php

namespace App\Adapters\Http\Requests;

use Illuminate\Http\Request;

abstract class AbstractRequest
{
    /** @var array validation rule */
    protected $validationRule = [];

    protected $request;

    public function __construct(Request $request)
    {
        $validator = \Validator::make($request->all(), $this->validationRule);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $this->request = $request;
    }

    /**
     * get parameter from request
     *
     * @return array
     */
    public function getParams()
    {
        return $this->request->all();
    }
}
