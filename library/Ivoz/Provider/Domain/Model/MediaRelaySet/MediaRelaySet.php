<?php

namespace Ivoz\Provider\Domain\Model\MediaRelaySet;

/**
 * MediaRelaySet
 */
class MediaRelaySet extends MediaRelaySetAbstract implements MediaRelaySetInterface
{
    use MediaRelaySetTrait;

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
