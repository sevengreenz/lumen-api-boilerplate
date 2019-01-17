<?php

namespace App\Domain\Factories;

use App\Domain\Sample;
use Illuminate\Support\Str;

trait SampleFactory
{
    /**
     * create sample entity
     *
     * @param array $params $title
     *                      $is_done
     *                      $created_at
     *
     * @return Sample
     */
    public function createSample($params): Sample
    {
        $id = $params['id'] ?? Str::orderedUuid();

        return new Sample(
            $id,
            $params['title'],
            $params['is_done'],
            isset($params['created_at']) ? new \Datetime($params['created_at']) : new \Datetime()
        );
    }
}
