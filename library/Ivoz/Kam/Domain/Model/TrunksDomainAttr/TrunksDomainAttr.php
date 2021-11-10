<?php

namespace Ivoz\Kam\Domain\Model\TrunksDomainAttr;

/**
 * TrunksDomainAttr
 */
class TrunksDomainAttr extends TrunksDomainAttrAbstract implements TrunksDomainAttrInterface
{
    use TrunksDomainAttrTrait;

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
