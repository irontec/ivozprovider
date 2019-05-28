<?php

namespace Ivoz\Kam\Domain\Model\TrunksCdr;

/**
 * TrunksCdr
 */
class TrunksCdr extends TrunksCdrAbstract implements TrunksCdrInterface
{
    use TrunksCdrTrait;

    const DIRECTION_OUTBOUND = 'outbound';

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function isOutboundCall()
    {
        return $this->getDirection() === self::DIRECTION_OUTBOUND;
    }
}
