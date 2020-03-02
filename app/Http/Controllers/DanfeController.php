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

        if ( !stripos($message, 'endereço:') )
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
            "nome"       => self::get_danfe_information($message, 'nome:'),
            "endereco"   => self::get_danfe_information($message, 'endereço:'),
            "valor"      => self::get_danfe_information($message, 'valor:'),
            "vencimento" => self::get_danfe_information($message, 'vencimento:'),
        ];

        return $danfe;
    }

    /**
     * Extracts information from message
     *
     * @param String $message
     * @param String $keyword
     * @return String
     */
    public static function get_danfe_information( $message, $keyword )
    {
        $str = substr( $message, stripos($message, $keyword) );
        $str = str_ireplace(["$keyword ", $keyword, "R$ ", "R$"], ['', '', '', ''], $str);

        preg_match ('/\r\n/', $str, $matches, PREG_OFFSET_CAPTURE);
        return substr($str, 0, $matches[0][1]);
    }
}
