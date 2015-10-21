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

    public function mentions($options = [], $filters = [])
    {
        return new Mentions($this->_makeRequest('mentions', $options, $filters));
    }

    /**
     * @param array $options
     * @param array $filters
     * @return WhatConcept
     */
    public function whatConcept($options = [], $filters = [])
    {
        return new WhatConcept($this->_makeRequest('analysis/what/concept', $options, $filters));
    }

    /**
     * @param array $options
     * @param array $filters
     * @return WhatClassifications
     */
    public function whatClassification($options = [], $filters = [])
    {
        return new WhatClassifications($this->_makeRequest('analysis/what/classifications', $options, $filters));
        //return json_decode($response->getBody()->getContents());
    }

    /**
     * @param array $options
     * @param array $filters
     * @return WhereMedia
     */
    public function whereMedia($options = [], $filters = [])
    {
        return new WhereMedia($this->_makeRequest('analysis/where/media', $options, $filters));
    }

    /**
     * @param array $options
     * @param array $filters
     * @return WhereGeography
     */
    public function whereGeography($options = [], $filters = [])
    {
        return new WhereGeography($this->_makeRequest('analysis/where/geography', $options, $filters));
    }

    /**
     * @param array $options
     * @param array $filters
     * @return WhenGraph
     */
    public function whenGraph($options = ['frequency'=>"DAILY"], $filters = [])
    {
        return new WhenGraph($this->_makeRequest('analysis/when', $options, $filters));
    }

    /**
     * @param array $options
     * @param array $filters
     * @return WhoGraph
     */
    public function whoGraph($options = [], $filters = [])
    {
        return new WhoGraph($this->_makeRequest('analysis/who', $options, $filters));
    }

    /**
     * @param array $options
     * @param array $filters
     */
    public function whoConcept($options = [], $filters = [])
    {
        //TODO: Add Who Concept
    }

    /**
     * @param array $options
     * @param array $filters
     * @return HowGraph
     */
    public function howGraph($options = [], $filters = [])
    {
        return new HowGraph($this->_makeRequest('analysis/how', $options, $filters));
    }

    /**
     * @param $uri
     * @param $options
     * @param array $filters
     * @return mixed
     */
    private function _makeRequest($uri, $options, $filters = [])
    {
        $uri = $this->request->base_uri . $uri . "?" . http_build_query($options) . $this->_buildFilters($filters, $options);
        return $this->request->client->request('GET', $uri);
    }

    /**
     * @param array $filters
     * @param array $options
     * @return string
     */
    private function _buildFilters(Array $filters, Array $options)
    {
        // Check if we already have some query string options in the string we'll be concatenating to via it's
        // options array.
        $filterStr = (sizeOf($options) > 0)? "&" : "";

        if(sizeOf($filters) > 0) {
            foreach ($filters as $key => $val) {
                $filterStr .= "filter=" . $key . ":" . urlencode($val) . "&";
            }
        }

        return rtrim($filterStr, "&");
    }
}
