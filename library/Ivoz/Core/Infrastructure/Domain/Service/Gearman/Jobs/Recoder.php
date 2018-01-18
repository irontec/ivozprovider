<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Manager;

class Recoder extends AbstractJob {

    protected $_id;
    protected $_entityName;
    protected $_method = "encodeFSOToMp3";
    protected $_mainVariables = array(
        '_id',
        '_entityName'
    );

    public function __construct(
        Manager $manager,
        array $settings
    ) {
        return parent::__construct($manager, $settings);
    }

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