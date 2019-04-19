<?php

namespace App\Adapters\Http\Requests;

use Illuminate\Http\Request;

abstract class AbstractRequest
{
    /** @var array route params */
    protected $routeParams = [];

    /** @var array validation rule */
    protected $validationRule = [];

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->validate();
    }

    public function validate()
    {
        $validator = \Validator::make($this->getParams(), $this->validationRule);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * get parameter from request
     *
     * @return array
     */
    public function getParams()
    {
        return $this->routeParams() + $this->request->all();
    }

    protected function routeParams()
    {
        return array_reduce($this->routeParams, function ($curry, $paramKey) {
            $curry[$paramKey] = $this->request->route($paramKey);
            return $curry;
        }, []);
    }
}
