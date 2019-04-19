<?php

namespace App\Adapters\Gateways;

use App\Adapters\Gateways\DataSources\Databases\SampleDatabase;
use App\Domain\Factories\SampleFactory;
use App\Domain\Repositories\SampleRepository as SampleRepositoryInterface;
use App\Domain\Sample;

class SampleRepository implements SampleRepositoryInterface
{
    use SampleFactory;

    protected $sampleDB;

    public function __construct(
        SampleDatabase $sampleDB
    ) {
        $this->sampleDB = $sampleDB;
    }

    public function create(Sample $sample): void
    {
        $this->sampleDB->create($sample);
    }

    public function find(array $params = []): array
    {
        return $this->sampleDB->find($params);
    }

    public function readById(string $sampleId): Sample
    {
        return $this->createSample(
            $this->sampleDB->read([
                'where' => [
                    'id' => $id,
                ]
            ])
        );
    }
}
