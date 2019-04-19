<?php

namespace App\UseCases\Interactors\Sample;

use App\Domain\Factories\SampleFactory;
use App\Domain\Repositories\SampleRepository;
use App\UseCases\Contracts\InputPortInterface;
use App\UseCases\Interactors\InputPort;

class CreateInteractor implements InputPortInterface
{
    use InputPort;
    use SampleFactory;

    protected $repository;

    public function __construct(SampleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function call(array $params): array
    {
        $Sample = $this->createSample($params);

        $this->repository->create($Sample);

        return [
            'id' => $Sample->getIdentifier()
        ];
    }
}
