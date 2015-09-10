<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 9/4/2015
 * Time: 10:44 AM
 */

namespace F2klabs\Digimind\request;

use \GuzzleHttp\Client;

class Request {


    public $client;

    protected $digimindClientCode;
    protected $auth;

    public function __construct()
    {
        //Get the Digimind Client Code
        //$this->digimindClientCode = env("DIGIMIND_CLIENT_CODE", Config::get('digimind.client_code'));
        $this->digimindClientCode = "rd1";

        //Get our Auth Variables
        $this->auth = [
                        env("DIGIMIND_USER", config('digimind.user')), //User
                        env("DIGIMIND_PASSWORD", config('digimind.password')) // Password
                      ];

        //Guzzle Client
        $this->client = new Client([
                "base_uri"=> "http://social.digimind.com/d/$this->digimindClientCode/api/",
                "auth" => $this->auth
            ]);
    }

    public function getAuth()
    {
        return $this->auth;
    }
}