<?php

namespace App\Http\Controllers;

use App\Http\Controllers\GuzzlehttpController;
use App\Http\Controllers\DanfeController;

class MainController extends Controller
{
    /**
     * Send objects extracted from email to api
     *
     * @return Boolean
     * @return \Illuminate\Http\JsonResponse
     */
    public static function send_danfes_to_api()
    {
        $danfes = DanfeController::index();
        if ( $danfes[0] == "empty" ) return response()->json( $danfes );

        $send = GuzzlehttpController::POST( env("ROUTE_TO_POST_DANFES"), $danfes );

        $response = ( $send[0] === 200 || $send[0] === 201 ) ? "success" : "fail";
        return response()->json( $response );
    }
}
