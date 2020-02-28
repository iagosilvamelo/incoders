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
            env('MAIL_ATTACHMENTS'),
        );
    }

    /**
     * Get all unseen messages
     *
     * @return Array $mails
     */
    public static function index()
    {
        $mails = [];

        try {
            $mailsIds = self::mail()->searchMailbox('UNSEEN');

        } catch( \PhpImap\Exceptions\ConnectionException $ex ) {
            $mails[0] = "error";
            $mails[1] = "IMAP connection failed: " . $ex;
        }

        if( !$mailsIds ) {
            $mails[0] = "empty";
        }

        else {
            foreach( $mailsIds as $id ) {
                array_push( $mails, self::prepare_structure( self::mail()->getMail($id) ) );
            }
        }

        return $mails;
    }

    /**
     * Find a especifc message
     *
     * @param Integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public static function find( $id )
    {
        return response()->json( self::prepare_structure( self::mail()->getMail($id) ) );
    }

    /**
     * Prepare response with userful data
     *
     * @param PhpImap\Mailbox $email
     * @return Array
     */
    public static function prepare_structure( $email )
    {
        return [
            'from-name'   => (isset($email->fromName)) ? $email->fromName : $email->fromAddress,
            'from-email'  => $email->fromAddress,
            'to'          => $email->to,
            'subject'     => $email->subject,
            'attachments' => ($email->hasAttachments()) ? true : false,
            'message'     => $email->textPlain
        ];
    }
}
