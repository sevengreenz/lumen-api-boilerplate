<?php

namespace App\UseCases\Contracts;

use App\UseCases\Contracts\OutputPortInterface;

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
