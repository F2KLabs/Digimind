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

        //Set Up our sentiment values
        $this->sentiment();
    }

    public function sentiment()
    {
        $series = $this->getContents()->series;

        //Dig out the Values for our Sentiment
        $positive = $series[0]->values[0]->count;
        $negative = $series[1]->values[0]->count;
        $neutral  = $series[2]->values[0]->count;

        //Get the Total for our Averages
        $total = $positive + $negative + $neutral;

        //Set our Values for later use
        $this->positive = ["total"=>$positive, "percentage"=>($positive/$total)*100];
        $this->negative = ["total"=>$negative, "percentage"=>($negative/$total)*100];
        $this->neutral  = ["total"=>$neutral,  "percentage"=>($neutral/$total) *100];
    }
}