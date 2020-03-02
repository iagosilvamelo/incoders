<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MailboxController;

class DanfeController extends Controller
{
    /**
     * Verify mailbox and extract nf info
     *
     * @param Integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public static function index()
    {
        return response()->json( "Ok" );
    }
}
