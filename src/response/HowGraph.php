<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 9/15/2015
 * Time: 12:49 PM
 */

namespace F2klabs\Digimind\response;

use GuzzleHttp\Psr7\Response as GuzzleResponse;

class HowGraph extends Response{

    public $positive;
    public $negative;
    public $neutral;

    public function __construct(GuzzleResponse $response)
    {
        parent::__construct($response);
        $this->sentiment();
    }

    public function sentiment()
    {
        $contents = $this->getContents();
        dd($contents);
        $this->positive = $contents;
    }
}