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

}