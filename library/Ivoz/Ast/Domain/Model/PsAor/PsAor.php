<?php

namespace Ivoz\Ast\Domain\Model\PsAor;

/**
 * PsAor
 */
class PsAor extends PsAorAbstract implements PsAorInterface
{
    use PsAorTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

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

