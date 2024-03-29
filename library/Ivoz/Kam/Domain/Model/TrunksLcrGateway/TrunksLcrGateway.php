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
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
