<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class EndpointTest extends TestCase
{
    /**
     * A basic test / endpoint.
     *
     * @return void
     */
    public function test_base_path()
    {
        $request = $this->get('/');

        $request->response->assertJson([
            'error' => true,
        ])->assertStatus(404);
    }

    public function test_get_version() {

        $this->get('/version');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );

    }

    public function test_ping() {

        $request = $this->get('/v1/ping');

        $request->response->assertSee('pong')->assertStatus(200);

    }
}
