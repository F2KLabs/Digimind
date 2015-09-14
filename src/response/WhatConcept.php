<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 9/9/2015
 * Time: 3:57 PM
 */

namespace F2klabs\Digimind\response;

class WhatConcept extends Response{

    /**
     * Return a Flot Ready Data Set for a What Concept Graph
     * @return mixed
     */
    public function toFlot()
    {
        return $this->contents;
    }

    public function hashtags()
    {
        $i = 0;
        $dataPoints = [];
        foreach($this->contents->series as $row)
        {
            array_push($dataPoints, ["rank"=>$i, "hashtag"=>$row->title, "count"=>$row->values[0]->count]);
            $i++;
        }

        return $dataPoints;
    }

}