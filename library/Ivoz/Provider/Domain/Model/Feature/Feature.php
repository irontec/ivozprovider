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
    public const OPERATOR_PANEL    = 13;

    /**
     * Available features constants
     */
    public const QUEUES_IDEN = 'queues';
    public const RECORDINGS_IDEN = 'recordings';
    public const FAXES_IDEN = 'faxes';
    public const FRIENDS_IDEN = 'friends';
    public const CONFERENCES_IDEN = 'conferences';
    public const BILLING_IDEN = 'billing';
    public const INVOICES_IDEN = 'invoices';
    public const PROGRESS_IDEN = 'progress';
    public const RESIDENTIAL_IDEN = 'residential';
    public const WHOLESALE_IDEN = 'wholesale';
    public const RETAIL_IDEN = 'retail';
    public const VPBX_IDEN = 'vpbx';
    public const OPERATOR_PANEL_IDEN = 'operatorPanel';

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
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
    public function getId(): ?int
    {
        return $this->id;
    }
}
