<?php

namespace Tests\Feature\Sample;

use Laravel\Lumen\Testing\DatabaseMigrations;

class CreateTest extends \TestCase
{
    use DatabaseMigrations;

    public function testSuccess()
    {
        $params = [
            'title'   => 'title',
            'is_done' => false
        ];

        $response = $this->post('/samples', $params)->response;

        $this->assertEquals(201, $response->status());

        $content = json_decode($response->content(), true);
        $this->assertArrayHasKey('id', $content);
        $this->assertArrayHasKey('_links', $content);

        $this->seeInDatabase('samples', [
            'id' => $content['id'],
        ]);

        $this->seeInDatabase('samples', [
            'id'        => $content['id'],
            'title'     => 'title',
            'is_done'   => false,
        ]);
    }
}
