<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MailboxController;

class DanfeController extends Controller
{
    /**
     * Verify mailbox and extract nf info
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function index()
    {
        $mails  = MailboxController::index();
        $danfes = [];

        foreach( $mails as $mail ) {
            $danfe = self::mail_handling($mail['message']);

            if ( !is_null($danfe) )
                array_push( $danfes, $danfe );
        }

        return response()->json( $danfes );
    }

    /**
     * Performs processing and extracts data from message
     *
     * @param String $message
     * @return Array
     */
    public static function mail_handling( $message )
    {
        return ( self::check_message( $message ) )
            ? self::extract_data($message)
            : null;
    }

    /**
     * Checks if the message meets the standards
     *
     * @param String $message
     * @return Bollean
     */
    public static function check_message( $message )
    {
        $check = true;

        if ( !stripos($message, 'nome:') )
            $check = false;

        if ( !self::multineedle_stripos($message, ['endereço:', 'endereco']) )
            $check = false;

        if ( !stripos($message, 'valor:') )
            $check = false;

        if ( !stripos($message, 'vencimento:') )
            $check = false;

        return $check;
    }

    /**
     * Extracts data from message
     *
     * @param String $message
     * @return Array
     */
    public static function extract_data( $message )
    {
        $danfe = [
            "nome" => self::get_danfe_name($message)
        ];

        return $danfe;
    }

    /**
     * Extracts 'nome' from message
     *
     * @param String $message
     * @return String
     */
    public static function get_danfe_name( $message )
    {
        $str = substr( $message, stripos($message, 'nome:') + 6 );
        $str_end = self::multineedle_stripos($str, ['endereço', 'endereco']);

        return substr($str, 0, $str_end);
    }

    /**
     * Search for multiples words in the string
     *
     * @param String $haystack
     * @param Array $needles
     * @param Int $offset
     * @return Int
     */
    public static function multineedle_stripos($haystack, $needles, $offset=0) {
        foreach($needles as $needle) {
            $tests[$needle] = stripos($haystack, $needle, $offset);
        }

        $check = false;
        foreach( $tests as $test) {
            if ($test) $check = $test;
        }

        return $check;
    }
}
