<?php

namespace Ivoz\Cgr\Domain\Model\TpCdrStat;

/**
 * TpCdrStat
 */
class TpCdrStat extends TpCdrStatAbstract implements TpCdrStatInterface
{
    use TpCdrStatTrait;

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
