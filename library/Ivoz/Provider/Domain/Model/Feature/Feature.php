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
    const RETAIL            = 9;

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

