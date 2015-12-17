<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/9/2015
 * Time: 9:43 PM
 */

namespace F2klabs\Digimind;


use F2klabs\Digimind\response\Response;

class TopicList extends  Model{

    protected $entitiesResponse;
    protected $entities;

    public function __construct($attributes)
    {
        parent::__construct();
        $this->attributes = $attributes;
    }

    public function entities()
    {
        if(!is_array($this->entities))
        {
            $this->entities = $this->_getEntitiesResponse()->termEntity;

            foreach ($this->entities as $key=>$val) {
                $this->entities[$key] = new ListEntity($val);
                $this->entities[$key]->listId = $this->id;
            }
        }

        return $this->entities;
    }

    public function entityCount()
    {
        return $this->_getEntitiesResponse()->count;
    }

    private function _getEntitiesResponse()
    {
        if(!is_object($this->entitiesResponse))
        {
            $this->_setEntities();
        }

        return $this->entitiesResponse;
    }

    private function _setEntities()
    {
        $this->entitiesResponse = Response::decodeContents($this->request->call('lists/queries/'.$this->id));
    }


}