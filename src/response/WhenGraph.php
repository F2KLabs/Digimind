<?php
namespace F2klabs\Digimind\response;

use Carbon\Carbon;

class WhenGraph extends Response{

    public function toFlot()
    {
        $contents = $this->getContents();
        $values = $contents->series[0]->values;

        $graphData = [];

        foreach($values as $dataPoint)
        {
            $time = Carbon::parse($dataPoint->time);

            array_push($graphData, [$time->timestamp * 1000, $dataPoint->count]);
        }

        $stats = $this->getChartStats($graphData);

        return ['stats'=>$stats, "graphData"=>$graphData];
    }

    protected function getChartStats(Array $data)
    {
        $maximum = 0;
        $minimum = PHP_INT_MAX;
        $average = 0;
        $total = 0;

        $i =0;
        foreach($data as $dataPoint)
        {
            $total += $dataPoint[1];

            if($dataPoint[1] > $maximum)
                $maximum = $dataPoint[1];

            if($dataPoint[1] < $minimum  )
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