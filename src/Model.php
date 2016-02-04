<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/9/2015
 * Time: 9:14 PM
 */

namespace F2klabs\Digimind;


class Model {

    protected $request;
    protected $client;
    protected $attributes;

    public function __construct()
    {
        $this->request = new request\Request();
        $this->client  = new Digimind($this->request);
    }

    public function __get($key)
    {
        return $this->attributes->$key;
    }

    public function __set($key,$val)
    {
        $this->attributes->$key = $val;
    }
}