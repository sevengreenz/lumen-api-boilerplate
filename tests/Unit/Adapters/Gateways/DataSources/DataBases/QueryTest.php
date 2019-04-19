<?php

namespace Tests\Unit\Adapters\Gateways\DataSources\Databases;

use App\Adapters\Gateways\DataSources\Databases\Query;
use Illuminate\Support\Facades\Artisan;

class QueryTest extends \TestCase
{
    public static $table = 'query_test';

    protected $test;

    public function setUp()
    {
        parent::setUp();

        Artisan::call('db:seed', ['--class' => 'Tests\Unit\Adapters\Gateways\DataSources\Databases\QueryTestSeeder']);

        // test trait
        $this->test = new class {
            use Query;

            public function table(): string
            {
                return 'query_test';
            }

            public function jsonColumn(): array
            {
                return [];
            }
        };
    }

    /**
     * @dataProvider findWhereProvider
     */
    public function testFindWhere($where, $expected)
    {
        $actual = $this->test->find(['where' => $where]);

        $this->assertEquals($expected, $actual);
    }

    public function findWhereProvider()
    {
        return [
            'count is equal to 5' => [
                ['count' => 5],
                [['id' => 2, 'count' => 5]]
            ],
            'count is 10 and more' => [
                ['count_gte' => 10],
                [['id' => 1, 'count' => 10], ['id' => 3, 'count' => 20]]
            ],
            'id in (1, 3)' => [
                ['id_in' => [1, 3]],
                [['id' => 1, 'count' => 10], ['id' => 3, 'count' => 20]]
            ]
        ];
    }

    /**
     * @dataProvider findSortProvider
     */
    public function testFindSort($sort, $expected)
    {
        $actual = $this->test->find(['sort' => $sort]);

        $this->assertEquals($expected, $actual);
    }

    public function findSortProvider()
    {
        return [
            'order by count asc' => [
                ['count' => 'asc'],
                [['id' => 2, 'count' => 5], ['id' => 1, 'count' => 10], ['id' => 3, 'count' => 20]]
            ],
            'order by count desc' => [
                ['count' => 'desc'],
                [['id' => 3, 'count' => 20], ['id' => 1, 'count' => 10], ['id' => 2, 'count' => 5]]
            ],
        ];
    }
}
