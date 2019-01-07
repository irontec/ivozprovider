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
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return self
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null);

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier();
}
