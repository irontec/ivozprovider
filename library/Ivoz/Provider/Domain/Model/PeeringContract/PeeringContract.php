<?php
namespace Ivoz\Provider\Domain\Model\PeeringContract;

/**
 * PeeringContract
 */
class PeeringContract extends PeeringContractAbstract implements PeeringContractInterface
{
    use PeeringContractTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

