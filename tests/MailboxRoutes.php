<?php

class MailboxRoutes extends TestCase
{
    public $mockConsoleOutput = true;

    /**
     * Test route: api/mailbox
     *
     * @return void
     */
    public function test_route_mailbox_index()
    {
        $response = $this->call('GET', 'api/mailbox');
        $this->assertEquals(200, $response->status());
    }

    /**
     * Test route: api/mailbox/{id}
     *
     * @return void
     */
    public function test_route_mailbox_find()
    {
        $response = $this->call('GET', 'api/mailbox/1');
        $this->assertEquals(200, $response->status());
    }
}
