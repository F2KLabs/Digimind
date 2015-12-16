<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 9/9/2015
 * Time: 3:51 PM
 */

namespace F2klabs\Digimind\response;

use GuzzleHttp\Psr7\Response as GuzzleResponse;

class Response {

    protected $response;
    protected $contents;

    protected $countries = array(
        "GB" => "Great Britian",
        "USA"=> "United States",
        "UK" => "United Kingdom"
    );

    protected $languages = array(
        "en" => "English",
    );


    public function __construct(GuzzleResponse $response)
    {
        $this->response = $response;
        $this->contents = json_decode($this->response->getBody()->getContents());
    }

    public function getContents()
    {
        return $this->contents;
    }

    protected function translateCountries($key)
    {
        if(is_null($key))
        {
            return "UNKNOWN";
        }

        if(array_key_exists(strtoupper($key), $this->countries))
        {
            return $this->countries[$key];
        }

        return $key;
    }

    protected function translateLanguages($key)
    {
        if(array_key_exists(strtoupper($key), $this->languages))
        {
            return $this->languages[$key];
        }

        return $key;
    }

    public static function decodeContents(GuzzleResponse $response)
    {
        return json_decode($response->getBody()->getContents());
    }
}