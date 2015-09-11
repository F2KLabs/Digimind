<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 9/11/2015
 * Time: 1:36 PM
 */

namespace F2klabs\Digimind\response;


class Mentions extends Response{


    public function toFlot()
    {
        dd($this->contents);

        return '';
    }

    public function countries()
    {
        $dataPoints = [];
        foreach($this->contents->mention as $row)
        {
            $translation = $this->translateCountries($row->country);

            if(array_key_exists($translation, $dataPoints))
            {
                $dataPoints[$translation]++;
            }
            else
            {
                $dataPoints[$translation] = 1;
            }
        }

        arsort($dataPoints);

        //Make it readable for flot bar chart
        //Data {Prep for Flot
        $i = 0;
        $ticks = [];
        $values = [];
        foreach($dataPoints as $key=>$val)
        {
            $ticks[$i] = $key;
            array_push($values, array($i, $val));
            $i++;
        }
        return ["ticks"=>$ticks, "values"=>$values];
    }

    public function languages()
    {
        $dataPoints = [];
        foreach($this->contents->mention as $row)
        {
            $translation = $this->translateLanguages($row->language);

            if(array_key_exists($translation, $dataPoints))
            {
                $dataPoints[$translation]++;
            }
            else
            {
                $dataPoints[$translation] = 1;
            }
        }

        arsort($dataPoints);
        //Make it readable for flot bar chart
        //Data {Prep for Flot
        $i = 0;
        $ticks = [];
        $values = [];
        foreach($dataPoints as $key=>$val)
        {
            $ticks[$i] = $key;
            array_push($values, array($i, $val));
            $i++;
        }
        return ["ticks"=>$ticks, "values"=>$values];
    }


}