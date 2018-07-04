<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

/**
 * DdiProvider
 */
class DdiProvider extends DdiProviderAbstract implements DdiProviderInterface
{
    use DdiProviderTrait;

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

