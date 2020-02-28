<?php

use App\Http\Controllers\GuzzlehttpController;

class Guzzlehttp extends TestCase
{
    public $mockConsoleOutput = true;

    //
    //  Endpoint used to tests
    //  https://jsonplaceholder.typicode.com
    //

    /**
     * Test GET method
     *
     * @return void
     */
    public function test_get_methodx()
    {
        $response = GuzzlehttpController::GET('/posts');
        $this->assertEquals(200, $response[0]);
    }

    /**
     * Test POST method
     *
     * @return void
     */
    public function test_post_methodx()
    {
        $data = array('title' => 'foo', 'body' => 'bar', 'userId' => 1);

        $response = GuzzlehttpController::POST('/posts', $data);
        $this->assertEquals(201, $response[0]);
    }

    /**
     * Test PUT method
     *
     * @return void
     */
    public function test_put_methodx()
    {
        $data = array('id' => 1, 'title' => 'foo', 'body' => 'bar', 'userId' => 1);

        $response = GuzzlehttpController::PUT('/posts/1', $data);
        $this->assertEquals(200, $response[0]);
    }

    /**
     * Test DELETE method
     *
     * @return void
     */
    public function test_delete_methodx()
    {
        $response = GuzzlehttpController::DELETE('/posts/1');
        $this->assertEquals(200, $response[0]);
    }
}
