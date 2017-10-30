<?php
namespace Ivoz\Provider\Domain\Model\LcrGateway;

/**
 * LcrGateway
 */
class LcrGateway extends LcrGatewayAbstract implements LcrGatewayInterface
{
    use LcrGatewayTrait;

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

