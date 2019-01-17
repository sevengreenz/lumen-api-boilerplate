<?php

namespace App\UseCases\Interactors\Sample;

use App\Domain\Repositories\SampleRepository;
use App\UseCases\Contracts\InputPortInterface;
use App\UseCases\Interactors\InputPort;
use App\UseCases\Interactors\ParamQueryMapper;

class ListInteractor implements InputPortInterface
{
    use InputPort;
    use ParamQueryMapper;

    protected $repository;

    public function __construct(SampleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function call(array $params): array
    {
        return [
            'list' => $this->repository->find($this->param2query($params))
        ];
    }
}
