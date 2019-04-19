<?php

namespace App\UseCases\Contracts;

interface InputPortInterface
{
    /**
     * execute usecase
     *
     * @param array $params 引数
     *
     * @return mix
     */
    public function execute(array $params, OutputPortInterface $output);
}
