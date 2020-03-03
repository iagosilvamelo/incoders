<?php

namespace App\Console\Commands;

use App\Http\Controllers\MainController;
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
    protected $signature = 'mailbox:send-danfes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Send objects extracted from email to api";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $status = MainController::send_danfes_to_api();

        if ( $status )
            $this->comment( "Dados enviados com sucesso." );

        else $this->error( "Erro ao enviar dados." );
    }
}
