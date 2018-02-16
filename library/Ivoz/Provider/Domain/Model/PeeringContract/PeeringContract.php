<?php
namespace Ivoz\Provider\Domain\Model\PeeringContract;

/**
 * PeeringContract
 */
class PeeringContract extends PeeringContractAbstract implements PeeringContractInterface
{
    use PeeringContractTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

