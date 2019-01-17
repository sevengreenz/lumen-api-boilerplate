<?php

namespace Tests\Unit\UseCases\Interactors;

use App\UseCases\Interactors\ParamQueryMapper;

class ParamQueryMapperTest extends \TestCase
{
    protected $test;

    public function setUp()
    {
        parent::setUp();

        $this->test = new class {
            use ParamQueryMapper;
        };
    }

    public function testSuccess()
    {
        $params = [
            '_select' => 'apple,banana',
            '_sort'   => 'soccer,baseball',
            '_order'  => 'desc',
            'fruit'   => 'apple',
        ];

        $actual = $this->test->param2query($params);

        $expected = [
            'select' => ['apple', 'banana'],
            'sort'   => [
                'soccer'   => 'desc',
                'baseball' => 'asc'
            ],
            'where'  => ['fruit' => 'apple']
        ];

        $this->assertEquals($actual, $expected);
    }

    public function testNoParams()
    {
        $actual = $this->test->param2query([]);

        $this->assertEquals($actual, []);
    }

    public function testSelectIsNotSpecified()
    {
        $params = [
            '_sort'   => 'soccer,baseball',
            '_order'  => 'desc',
            'fruit'   => 'apple',
        ];

        $actual = $this->test->param2query($params);

        $expected = [
            'sort'   => [
                'soccer'   => 'desc',
                'baseball' => 'asc'
            ],
            'where' => ['fruit' => 'apple']
        ];

        $this->assertEquals($actual, $expected);
    }

    public function testSortIsNotSpecified()
    {
        $params = [
            '_select' => 'apple,banana',
            '_order'  => 'desc',
            'fruit'   => 'apple',
        ];

        $actual = $this->test->param2query($params);

        $expected = [
            'select' => ['apple', 'banana'],
            'where'  => ['fruit' => 'apple']
        ];

        $this->assertEquals($actual, $expected);
    }
}
