<?php

namespace App\Domain\Repositories;

use App\Domain\Sample;

interface SampleRepository
{
    /**
     * create sample data
     *
     * @param Sample $sample
     *
     * @return void
     */
    public function create(Sample $sample): void;

    /**
     * get sample data
     *
     * @param string $id
     *
     * @return Marual
     */
    public function readById(string $id): Sample;

    /**
     * get sample data list
     *
     * @param array $options query options
     *
     * @return array
     */
    public function find(array $options = []): array;
}
