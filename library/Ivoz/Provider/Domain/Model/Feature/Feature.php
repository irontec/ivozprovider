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
    public const QUEUES            = 1;
    public const RECORDINGS        = 2;
    public const FAXES             = 3;
    public const FRIENDS           = 4;
    public const CONFERENCES       = 5;
    public const BILLING           = 6;
    public const INVOICES          = 7;
    public const PROGRESS          = 8;
    public const RESIDENTIAL       = 9;
    public const WHOLESALE         = 10;
    public const RETAIL            = 11;
    public const VPBX              = 12;

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
