<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/9/2015
 * Time: 9:54 PM
 */

namespace F2klabs\Digimind;


class ListEntity extends Model{

    public function __construct($attributes)
    {
        parent::__construct();
        $this->attributes = $attributes;
    }

}