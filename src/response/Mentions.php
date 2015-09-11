<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 9/11/2015
 * Time: 1:36 PM
 */

namespace F2klabs\Digimind\response;


class Mentions extends Response{

    protected $counties = [
        "GB" => "Great Britian",
        "USA"=> "United States",
        "UK" => "United Kingdom"
    ];

    protected $languages = [
        "en" => "English",
    ];

    public function toFlot()
    {
        dd($this->contents);

        return '';
    }

}