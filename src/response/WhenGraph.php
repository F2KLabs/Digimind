<?php
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

        $graphData = array_reverse($result);
        $stats = $this->getChartStats($graphData);

        return ['stats'=>$stats, "graphData"=>$graphData];
    }

    protected function getChartStats(Array $data)
    {
        $minimum = PHP_INT_MAX;
        $maximum = 0;
        $average = 0;
        $total = 0;

        $i =0;
        foreach($data as $dataPoint)
        {
            $total += $dataPoint[1];

            if($dataPoint[1] > $maximum)
                $maximum = $dataPoint[1];

            if($minimum < $dataPoint[1])
            {
                $minimum = $dataPoint[1];
            }

            //Iterate for Average
            $i++;
        }

        $average = round(($total/$i));

        return ["total"=>$total, "average"=>$average, "minimum"=>$minimum, "maximum"=>$maximum];

    }

}