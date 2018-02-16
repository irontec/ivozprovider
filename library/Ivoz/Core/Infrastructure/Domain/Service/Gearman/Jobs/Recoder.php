<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Manager;

class Recoder extends AbstractJob {

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $entityName;

    /**
     * @var string
     */
    protected $method = "WorkerMultimedia~encode";

    /**
     * @var array
     */
    protected $mainVariables = array(
        'id',
        'entityName'
    );

    /**
     * Recoder constructor.
     *
     * @param Manager $manager
     * @param array $settings
     */
    public function __construct(Manager $manager, array $settings)
    {
        return parent::__construct($manager, $settings);
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setEntityName($entityName)
    {
        $this->entityName = $entityName;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEntityName()
    {
        return $this->entityName;
    }
}