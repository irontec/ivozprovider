<?php

namespace Ivoz\Cgr\Domain\Model\TpCdr;

/**
 * TpCdr
 */
class TpCdr extends TpCdrAbstract implements TpCdrInterface
{
    use TpCdrTrait;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getDuration()
    {
        $usage = $this->getUsage();
        if (!$usage) {
            return null;
        }

        return $usage / (1000 * 1000 * 1000);
    }
}

