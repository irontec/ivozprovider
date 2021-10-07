<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrGateway;

/**
 * LcrGateway
 */
class TrunksLcrGateway extends TrunksLcrGatewayAbstract implements TrunksLcrGatewayInterface
{
    use TrunksLcrGatewayTrait;

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
