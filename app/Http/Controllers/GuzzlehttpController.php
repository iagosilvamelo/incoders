<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use GuzzleHttp\Client;

class GuzzlehttpController extends Controller
{
    /**
     * Create a new connection.
     *
     * @return \GuzzleHttp\Client
     */
    public static function client()
    {
        return new Client([
            'base_uri' => env('GUZZLEHTTP_ENDPOINT'),
            'timeout'  => env('GUZZLEHTTP_TIMEOUT', 10)
        ]);
    }

    /**
     * GET http request
     *
     * @param String $route
     * @return Array
     */
    public static function GET($route)
    {
        $response = self::client()->get($route);
        return [ $response->getStatusCode(), $response->getBody()->getContents() ];
    }

    /**
     * POST http request
     *
     * @param String $route
     * @param Object $data
     * @return Array
     */
    public static function POST($route, $data)
    {
        $response = self::client()->post($route, [ "form_params" => $data ]);
        return [ $response->getStatusCode(), $response->getBody()->getContents() ];
    }

    /**
     * POST http request
     *
     * @param String $route
     * @param Object $data
     * @return Array
     */
    public static function PUT($route, $data)
    {
        $response = self::client()->put($route, [ "form_params" => $data ]);
        return [ $response->getStatusCode(), $response->getBody()->getContents() ];
    }

    /**
     * POST http request
     *
     * @param String $route
     * @return Array
     */
    public static function DELETE($route)
    {
        $response = self::client()->delete($route);
        return [ $response->getStatusCode(), $response->getBody()->getContents() ];
    }
}
