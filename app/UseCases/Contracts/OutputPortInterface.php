<?php

namespace App\UseCases\Contracts;

interface OutputPortInterface
{
    /**
     * usecase success
     *
     * @param array $result
     *
     * @return array
     */
    public function success(array $result);
}
