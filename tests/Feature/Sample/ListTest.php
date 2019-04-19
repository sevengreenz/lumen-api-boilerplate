<?php

namespace Tests\Feature\Sample;

use Illuminate\Support\Facades\Artisan;
use Laravel\Lumen\Testing\DatabaseMigrations;

class ListTest extends \TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('db:seed', ['--class' => 'Tests\Feature\Sample\ListTestSeeder']);
    }

    public function testRecent()
    {
        $params = [
            '_sort'      => 'created_at',
            '_order'     => 'desc'
        ];

        $response = $this->get(sprintf('/samples?%s', http_build_query($params)))
            ->response;

        $this->assertEquals(200, $response->status());

        $content = json_decode($response->content(), true);
        $this->assertArrayHasKey('_links', $content);

        $expected = [
            [
                'id'         => 'def',
                'title'      => 'second',
                'is_done'    => 0,
                'created_at' => '2017-07-12 00:00:00',
            ],
            [
                'id'         => 'ghi',
                'title'      => 'third',
                'is_done'    => 1,
                'created_at' => '2017-07-11 00:00:00',
            ],
            [
                'id'         => 'abc',
                'title'      => 'first',
                'is_done'    => 0,
                'created_at' => '2017-07-10 00:00:00',
            ],
        ];

        $this->assertEquals($expected, $content['list']);
    }
}
