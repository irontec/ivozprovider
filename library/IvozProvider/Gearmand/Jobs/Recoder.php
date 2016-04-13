<?php
namespace IvozProvider\Gearmand\Jobs;

class Recoder extends AbstractJob {

    protected $_id;
    protected $_modelName;

    protected $_mainVariables = array(
            '_id','_modelName'
    );


    protected $_method = "encodeFSOToMp3";


    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    public function setModelName($modelName)
    {
        $this->_modelName = $modelName;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getModelName()
    {
        return $this->_modelName;
    }
}