<?php

namespace Ivoz\Provider\Infrastructure\Gearman\Jobs;

use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\AbstractJob;
use Ivoz\Provider\Domain\Job\RecoderJobInterface;

class Recoder extends AbstractJob implements RecoderJobInterface
{
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

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setEntityName($entityName): self
    {
        $this->entityName = $entityName;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEntityName(): string
    {
        return $this->entityName;
    }
}
