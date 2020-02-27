<?php

class MailboxTest extends TestCase
{
    public $mockConsoleOutput = true;

    /**
     * Test artisan command: mailbox:check-messages
     *
     * @return void
     */
    public function test_check_mailbox_messages_command()
    {
        $command = $this->artisan("mailbox:check-messages");
        assert($command != 0, 'The command is ok.');
    }

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
}
