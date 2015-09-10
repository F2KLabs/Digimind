<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 9/9/2015
 * Time: 7:14 PM
 */

namespace F2klabs\Digimind\response;


use Carbon\Carbon;

class WhenGraph extends Response{

    public function toFlot()
    {
        $contents = $this->getContents();
        $values = $contents->series[0]->values;

        $result = [];

        foreach($values as $dataPoint)
        {
            $time = Carbon::parse($dataPoint->time);

            array_push($result, [$time->timestamp, $dataPoint->count]);
        }

        return array_reverse($result);
    }

}