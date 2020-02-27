<?php

namespace App\Http\Controllers;

use PhpImap\Mailbox;

class MailboxController extends Controller
{
    /**
     * Create a new connection to mailbox.
     *
     * @return \PhpImap\Mailbox
     */
    public static function mail()
    {
        return new Mailbox(
            env('MAIL_SERVER'),
            env('MAIL_USERNAME'),
            env('MAIL_PASSWORD'),
            env('MAIL_ATCDIR'),
        );
    }

    /**
     * Get all messages
     *
     * @return Array $mails
     */
    public static function get_messages()
    {
        $mails = [];

        try {
            $mailsIds = self::mail()->searchMailbox('ALL');

        } catch( \PhpImap\Exceptions\ConnectionException $ex ) {
            $mails[0] = "error";
            $mails[1] = "IMAP connection failed: " . $ex;
        }

        if( !$mailsIds ) {
            $mails[0] = "empty";
        }

        else {
            foreach( $mailsIds as $id ) {
                array_push( $mails, self::mail()->getMail($id) );
            }
        }

        return $mails;
    }
}
