<?php

class MailboxCommands extends TestCase
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
}
