<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 9/4/2015
 * Time: 11:33 AM
 */

namespace F2klabs\Digimind;

use F2klabs\Digimind\request\Request as DigiRequest;
use F2klabs\Digimind\response\HowGraph;
use F2klabs\Digimind\response\Mentions;
use F2klabs\Digimind\response\WhatClassifications;
use F2klabs\Digimind\response\WhatConcept;
use F2klabs\Digimind\response\WhenGraph;
use F2klabs\Digimind\response\WhereGeography;
use F2klabs\Digimind\response\WhereMedia;
use F2klabs\Digimind\response\WhoGraph;
use F2klabs\Digimind\response\Topics;
use GuzzleHttp\Exception\ClientException;

class Digimind {

    protected $digiRequest;

    public function __construct(DigiRequest $request)
    {
        $this->digiRequest = $request;
    }

    public function mentions($options = [], $filters = [])
    {
        return new Mentions($this->digiRequest->call('mentions', $options, $filters));
    }

    /**
     * @param array $options
     * @param array $filters
     * @return WhatConcept
     */
    public function whatConcept($options = [], $filters = [])
    {
        return new WhatConcept($this->digiRequest->call('analysis/what/concept', $options, $filters));
    }

    /**
     * @param array $options
     * @param array $filters
     * @return WhatClassifications
     */
    public function whatClassification($options = [], $filters = [])
    {
        return new WhatClassifications($this->digiRequest->call('analysis/what/classifications', $options, $filters));
        //return json_decode($response->getBody()->getContents());
    }

    /**
     * @param array $options
     * @param array $filters
     * @return WhereMedia
     */
    public function whereMedia($options = [], $filters = [])
    {
        return new WhereMedia($this->digiRequest->call('analysis/where/media', $options, $filters));
    }

    /**
     * @param array $options
     * @param array $filters
     * @return WhereGeography
     */
    public function whereGeography($options = [], $filters = [])
    {
        return new WhereGeography($this->digiRequest->call('analysis/where/geography', $options, $filters));
    }

    /**
     * @param array $options
     * @param array $filters
     * @return WhenGraph
     */
    public function whenGraph($options = ['frequency'=>"DAILY"], $filters = [])
    {
        return new WhenGraph($this->digiRequest->call('analysis/when', $options, $filters));
    }

    /**
     * @param array $options
     * @param array $filters
     * @return WhoGraph
     */
    public function whoGraph($options = [], $filters = [])
    {
        return new WhoGraph($this->digiRequest->call('analysis/who', $options, $filters));
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
        return new HowGraph($this->digiRequest->call('analysis/how', $options, $filters));
    }

    public function topic($id)
    {
        return new Topics($this->digiRequest->call('topic/'.$id));
    }


}
