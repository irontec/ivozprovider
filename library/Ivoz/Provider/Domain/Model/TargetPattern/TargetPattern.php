<?php

namespace Ivoz\Provider\Domain\Model\TargetPattern;

/**
 * TargetPattern
 */
class TargetPattern extends TargetPatternAbstract implements TargetPatternInterface
{
    use TargetPatternTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

