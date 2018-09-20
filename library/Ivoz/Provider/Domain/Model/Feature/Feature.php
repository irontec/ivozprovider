<?php

namespace Ivoz\Provider\Domain\Model\Feature;

/**
 * Feature
 */
class Feature extends FeatureAbstract implements FeatureInterface
{
    use FeatureTrait;

    /**
     * Available features Ids
     */
    const QUEUES            = 1;
    const RECORDINGS        = 2;
    const FAXES             = 3;
    const FRIENDS           = 4;
    const CONFERENCES       = 5;
    const BILLING           = 6;
    const INVOICES          = 7;
    const PROGRESS          = 8;
    const RESIDENTIAL       = 9;
    const WHOLESALE         = 10;
    const RETAIL            = 11;
    const VPBX              = 12;

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
