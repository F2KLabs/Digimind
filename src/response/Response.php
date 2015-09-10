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

    public function __construct(GuzzleResponse $response)
    {
        $this->response = $response;
        $this->contents = json_decode($this->response->getBody()->getContents());
    }

    public function getContents()
    {
        return $this->contents;
    }
}