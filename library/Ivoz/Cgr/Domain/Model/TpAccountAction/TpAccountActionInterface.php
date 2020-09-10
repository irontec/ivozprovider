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
    public function getTpid(): string;

    /**
     * Get loadid
     *
     * @return string
     */
    public function getLoadid(): string;

    /**
     * Get tenant
     *
     * @return string
     */
    public function getTenant(): string;

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount(): string;

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
    public function getAllowNegative(): bool;

    /**
     * Get disabled
     *
     * @return boolean
     */
    public function getDisabled(): bool;

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime;

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

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
