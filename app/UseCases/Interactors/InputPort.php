<?php

namespace App\UseCases\Interactors;

use App\UseCases\Contracts\OutputPortInterface;

trait InputPort
{
    /**
     * @param array               $params
     * @param OutputPortInterface $output
     *
     * @return mix
     */
    public function execute(array $params, OutputPortInterface $output)
    {
        $result = $this->call($params);

        return $output->success($result);
    }

    /**
     * @param array $params
     *
     * @return array
     */
    abstract protected function call(array $params): array;
}
