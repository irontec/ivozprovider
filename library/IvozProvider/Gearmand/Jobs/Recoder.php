<?php
namespace IvozProvider\Gearmand\Jobs;

class Recoder extends AbstractJob {

    protected $_id;
    protected $_entityName;

    protected $_mainVariables = array(
        '_id',
        '_entityName'
    );

    protected $_method = "encodeFSOToMp3";

    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    public function setEntityName($modelName)
    {
        $this->_entityName = $modelName;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getEntityName()
    {
        return $this->_entityName;
    }
}