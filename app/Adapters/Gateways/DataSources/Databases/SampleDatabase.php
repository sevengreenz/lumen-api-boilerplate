<?php

namespace App\Adapters\Gateways\DataSources\Databases;

use App\Domain\Sample;
use Illuminate\Support\Facades\DB;

class SampleDatabase
{
    use Query;

    protected const TABLE = 'samples';

    public function table(): string
    {
        return self::TABLE;
    }

    public function jsonColumn(): array
    {
        return [];
    }

    /**
     * create record
     *
     * @param Sample $sample sample entity
     *
     * @return int
     */
    public function create(Sample $sample)
    {
        $value = [
            'id'         => $sample->getIdentifier(),
            'title'      => $sample->title,
            'is_done'    => $sample->isDone,
            'created_at' => $sample->createdAt->format('Y-m-d H:i:s')
        ];

        DB::table(static::TABLE)
            ->insert($value);
    }
}
