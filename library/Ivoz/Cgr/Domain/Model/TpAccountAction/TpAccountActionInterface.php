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
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

}

