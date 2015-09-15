<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 9/4/2015
 * Time: 11:33 AM
 */

namespace F2klabs\Digimind;

use F2klabs\Digimind\request\Request;
use F2klabs\Digimind\response\HowGraph;
use F2klabs\Digimind\response\Mentions;
use F2klabs\Digimind\response\WhatClassifications;
use F2klabs\Digimind\response\WhatConcept;
use F2klabs\Digimind\response\WhenGraph;
use F2klabs\Digimind\response\WhereGeography;
use F2klabs\Digimind\response\WhereMedia;
use F2klabs\Digimind\response\WhoGraph;
use GuzzleHttp\Exception\ClientException;

class Digimind {

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function mentions($options = [])
    {
        return new Mentions($this->_makeRequest('mentions', $options));
    }

    /**
     * @param array $options
     * @return WhatConcept
     */
    public function whatConcept($options = [])
    {
        return new WhatConcept($this->_makeRequest('analysis/what/concept', $options));
    }

    /**
     * @param array $options
     * @return WhatClassifications
     */
    public function whatClassification($options = [])
    {
        return new WhatClassifications($this->_makeRequest('analysis/what/classifications', $options));
        //return json_decode($response->getBody()->getContents());
    }

    /**
     * @param array $options
     * @return WhereMedia
     */
    public function whereMedia($options = [])
    {
        return new WhereMedia($this->_makeRequest('analysis/where/media', $options));
    }

    public function whereGeography($options = [])
    {
        return new WhereGeography($this->_makeRequest('analysis/where/geography', $options));
    }

    /**
     * @param array $options
     * @return WhenGraph
     */
    public function whenGraph($options = ['frequency'=>"DAILY"])
    {
        return new WhenGraph($this->_makeRequest('analysis/when', $options));
    }

    /**
     * @param array $options
     * @return WhoGraph
     */
    public function whoGraph($options = [])
    {
        return new WhoGraph($this->_makeRequest('analysis/who', $options));
    }

    /**
     * @param array $options
     */
    public function whoConcept($options = [])
    {

    }

    public function howGraph($options = [])
    {
        return new HowGraph($this->_makeRequest('analysis/how', $options));
    }


    private function _makeRequest($uri, $options)
    {
        return $this->request->client->get($uri, ['query'=>$options]);
    }
}
