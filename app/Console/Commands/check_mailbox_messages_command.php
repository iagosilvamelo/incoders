<?php

namespace App\Console\Commands;

use App\Http\Controllers\MailboxController;
use Illuminate\Console\Command;

/**
 * Class GetBlackListCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class check_mailbox_messages_command extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'mailbox:check-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Return count messages to defined mail in .env";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mails = MailboxController::get_messages();

        if ( $mails[0] === "empty" )
            $this->line( "Mailbox is empty." );

        else if ( $mails[0] === "error" )
            $this->line( $mails[1] );

        else $this->line( "You have " . sizeof( $mails ) . " messages in mailbox." );
    }
}
