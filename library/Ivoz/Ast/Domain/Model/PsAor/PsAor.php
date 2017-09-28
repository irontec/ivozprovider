<?php

namespace Ivoz\Ast\Domain\Model\PsAor;

/**
 * PsAor
 */
class PsAor extends PsAorAbstract implements PsAorInterface
{
    use PsAorTrait;

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}

