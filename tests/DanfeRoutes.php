<?php

class DanfeRoutes extends TestCase
{
    public $mockConsoleOutput = true;

    /**
     * Test route: api/danfe/verify-mail
     *
     * @return void
     */
    public function test_route_danfe_index()
    {
        $response = $this->call('GET', 'api/danfe/verify-mail');
        $this->assertEquals(200, $response->status());
    }
}
