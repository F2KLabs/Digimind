<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 9/9/2015
 * Time: 7:16 PM
 */

namespace F2klabs\Digimind\response;


class WhoGraph extends Response{


    public function toFlot()
    {
        dd($this->contents);
    }

    public function influencersTable()
    {
        $dataPoints = [];
        foreach($this->contents->series as $row)
        {
            array_push($dataPoints, $row->values[0]);
        }

        return array_reverse($dataPoints);
    }
}