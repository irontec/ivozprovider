<?php

namespace Ivoz\Provider\Domain\Model\Timezone;

/**
 * Timezone
 */
class Timezone extends TimezoneAbstract implements TimezoneInterface
{
    use TimezoneTrait;

    /**
     * @codeCoverageIgnore
     * @return array
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
    public function getId()
    {
        return $this->id;
    }
}
