<?php

namespace Ivoz\Kam\Domain\Model\TrunksHtable;

/**
 * TrunksHtable
 */
class TrunksHtable extends TrunksHtableAbstract implements TrunksHtableInterface
{
    use TrunksHtableTrait;

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
