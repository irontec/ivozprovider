<?php

namespace Ivoz\Provider\Domain\Model\TargetPattern;

/**
 * TargetPattern
 */
class TargetPattern extends TargetPatternAbstract implements TargetPatternInterface
{
    use TargetPatternTrait;

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

