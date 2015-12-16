<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/9/2015
 * Time: 8:53 PM
 */

namespace F2klabs\Digimind;

use \F2klabs\Digimind\response\Response;

class Topic extends Model {

    public $attributes;
    public $listResponse;
    public $lists;
    public $entities;

    public function __construct($id)
    {
        parent::__construct();
        $this->attributes = $this->client->topic($id)->getContents();
    }

    public function lists()
    {
        if(!is_array($this->lists))
        {
            $this->lists = $this->_getListsResponse()->topicList;

            foreach ($this->lists as $key=>$val) {
                $this->lists[$key] = new TopicList($val);
            }
        }

        return $this->lists;
    }

    public function entities()
    {
        if(!is_array($this->entities))
        {
            $this->entities = [];

            foreach($this->lists() as $topicList)
            {
                $this->entities += $topicList->entities();
            }
        }

        return $this->entities;
    }

    public function listCount()
    {
        return $this->_getListsResponse()->count;
    }

    private function _getListsResponse()
    {
        if(!is_object($this->listResponse))
        {
            $this->_setLists();
        }

        return $this->listResponse;
    }

    private function _setLists()
    {
        $this->listResponse = Response::decodeContents($this->request->call('topic/'.$this->id.'/lists'));
    }



}