<?php

namespace Ivoz\Cgr\Domain\Model\TpAccountAction;

/**
 * TpAccountAction
 */
class TpAccountAction extends TpAccountActionAbstract implements TpAccountActionInterface
{
    use TpAccountActionTrait;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * @TODO Optional oneToOne
     *
     * @inheritdoc
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        if (!is_null($company)) {
            parent::setCompany($company);
        }
        return $this;
    }

    /**
     * @TODO Optional oneToOne
     *
     * @inheritdoc
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null)
    {
        if (!is_null($carrier)) {
            parent::setCarrier($carrier);
        }
        return $this;
    }
}
