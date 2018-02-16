<?php
namespace Ivoz\Provider\Domain\Model\LcrGateway;

/**
 * LcrGateway
 */
class LcrGateway extends LcrGatewayAbstract implements LcrGatewayInterface
{
    use LcrGatewayTrait;

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

