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
     * @deprecated
     * Set tpid
     *
     * @param string $tpid
     *
     * @return self
     */
    public function setTpid($tpid);

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid();

    /**
     * @deprecated
     * Set loadid
     *
     * @param string $loadid
     *
     * @return self
     */
    public function setLoadid($loadid);

    /**
     * Get loadid
     *
     * @return string
     */
    public function getLoadid();

    /**
     * @deprecated
     * Set tenant
     *
     * @param string $tenant
     *
     * @return self
     */
    public function setTenant($tenant);

    /**
     * Get tenant
     *
     * @return string
     */
    public function getTenant();

    /**
     * @deprecated
     * Set account
     *
     * @param string $account
     *
     * @return self
     */
    public function setAccount($account);

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount();

    /**
     * @deprecated
     * Set actionPlanTag
     *
     * @param string $actionPlanTag
     *
     * @return self
     */
    public function setActionPlanTag($actionPlanTag = null);

    /**
     * Get actionPlanTag
     *
     * @return string
     */
    public function getActionPlanTag();

    /**
     * @deprecated
     * Set actionTriggersTag
     *
     * @param string $actionTriggersTag
     *
     * @return self
     */
    public function setActionTriggersTag($actionTriggersTag = null);

    /**
     * Get actionTriggersTag
     *
     * @return string
     */
    public function getActionTriggersTag();

    /**
     * @deprecated
     * Set allowNegative
     *
     * @param boolean $allowNegative
     *
     * @return self
     */
    public function setAllowNegative($allowNegative);

    /**
     * Get allowNegative
     *
     * @return boolean
     */
    public function getAllowNegative();

    /**
     * @deprecated
     * Set disabled
     *
     * @param boolean $disabled
     *
     * @return self
     */
    public function setDisabled($disabled);

    /**
     * Get disabled
     *
     * @return boolean
     */
    public function getDisabled();

    /**
     * @deprecated
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    public function getCarrier();

}

