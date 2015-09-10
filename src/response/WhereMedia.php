<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 9/9/2015
 * Time: 7:19 PM
 */

namespace F2klabs\Digimind\response;


class WhereMedia extends Response{

    public function toFlot()
    {
        $series = $this->contents->series;
        $graphData = [];
        $total = 0;
        foreach ($series as $dataPoint)
        {
            $graphData[$dataPoint->title] = $dataPoint->values[0]->count;
            $total += $dataPoint->values[0]->count;
        }

        $graphData['total'] = $total;

        return $graphData;
    }
}