<?php

namespace App\Adapters\Http\Controllers;

use App\Adapters\Http\Requests\Sample\CreateRequest;
use App\Adapters\Http\Requests\Sample\ListRequest;
use App\Adapters\Http\Responses\Sample\CreateResponse;
use App\Adapters\Http\Responses\Sample\ListResponse;
use App\UseCases\Interactors\Sample\CreateInteractor;
use App\UseCases\Interactors\Sample\ListInteractor;

class SampleController extends Controller
{
    public function store(CreateRequest $request, CreateResponse $response, CreateInteractor $usecase)
    {
        $params = $request->getParams();

        return $usecase->execute($params, $response);
    }

    public function list(ListRequest $request, ListResponse $response, ListInteractor $usecase)
    {
        $params = $request->getParams();

        return $usecase->execute($params, $response);
    }
}
