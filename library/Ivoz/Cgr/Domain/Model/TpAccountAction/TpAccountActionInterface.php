<?php

namespace Ivoz\Cgr\Domain\Model\TpAccountAction;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TpAccountActionInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @TODO Optional oneToOne
     *
     * @inheritdoc
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * @TODO Optional oneToOne
     *
     * @inheritdoc
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null);

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid();

    /**
     * Get loadid
     *
     * @return string
     */
    public function getLoadid();

    /**
     * Get tenant
     *
     * @return string
     */
    public function getTenant();

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount();

    /**
     * Get actionPlanTag
     *
     * @return string | null
     */
    public function getActionPlanTag();

    /**
     * Get actionTriggersTag
     *
     * @return string | null
     */
    public function getActionTriggersTag();

    /**
     * Get allowNegative
     *
     * @return boolean
     */
    public function getAllowNegative();

    /**
     * Get disabled
     *
     * @return boolean
     */
    public function getDisabled();

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier();
}
