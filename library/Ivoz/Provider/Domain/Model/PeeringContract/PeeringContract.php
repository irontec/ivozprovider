<?php
namespace Ivoz\Provider\Domain\Model\PeeringContract;

/**
 * PeeringContract
 */
class PeeringContract extends PeeringContractAbstract implements PeeringContractInterface
{
    use PeeringContractTrait;

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

