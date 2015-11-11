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

    public $positive = ["total"=>0, "percentage"=>0];
    public $negative = ["total"=>0, "percentage"=>0];
    public $neutral = ["total"=>0, "percentage"=>0];

    public function __construct(GuzzleResponse $response)
    {
        parent::__construct($response);

        //Set Up our sentiment values
        $this->sentiment();
    }

    public function sentiment()
    {
        $data = [];
        $total = 0;
        $series = $this->getContents()->series;

        foreach($series as $point)
        {
            if(sizeof($point->values)) {
                $data[$point->title] = $point->values[0]->count;
                $total += $point->values[0]->count;
            }

        }

        //Set our Values for later use
        $this->positive = (array_key_exists('positive', $data))?
            ["total"=>$data['positive'], "percentage"=>($data['positive']/$total)*100]
            : $this->positive;
        $this->negative = (array_key_exists('negative', $data))?
            ["total"=>$data['negative'], "percentage"=>($data['negative']/$total)*100]
            : $this->negative ;
        $this->neutral  = (array_key_exists('neutral', $data))?
            ["total"=>$data['neutral'],  "percentage"=>($data['neutral']/$total) *100]
            : $this->neutral;
    }
}