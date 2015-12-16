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
    public $base_uri;

    protected $digimindClientCode;
    protected $auth;


    public function __construct()
    {
        //Get the Digimind Client Code
        $this->digimindClientCode = env("DIGIMIND_CLIENT_CODE", config('digimind.client_code'));
        
        $this->base_uri = "http://social.digimind.com/d/$this->digimindClientCode/api/";

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

    /**
     * @param $uri
     * @param array $options
     * @param array $filters
     * @return mixed
     */
    public function call($uri, $options = [], $filters = [])
    {
        $uri = $this->base_uri . $uri . "?" . http_build_query($options) . $this->_buildFilters($filters, $options);
        return $this->client->request('GET', $uri);
    }

    /**
     * @param array $filters
     * @param array $options
     * @return string
     */
    private function _buildFilters(Array $filters, Array $options)
    {
        // Check if we already have some query string options in the string we'll be concatenating to via it's
        // options array.
        $filterStr = (sizeOf($options) > 0)? "&" : "";

        if(sizeOf($filters) > 0) {
            foreach ($filters as $key => $val) {
                $filterStr .= "filter=" . $key . ":" . urlencode($val) . "&";
            }
        }

        return rtrim($filterStr, "&");
    }
}