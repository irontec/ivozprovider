<?php

namespace Ivoz\Cgr\Domain\Model\TpAccountAction;

use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* TpAccountActionInterface
*/
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
    public function getActionPlanTag(): ?string;

    /**
     * Get actionTriggersTag
     *
     * @return string | null
     */
    public function getActionTriggersTag(): ?string;

    /**
     * Get allowNegative
     *
     * @return bool
     */
    public function getAllowNegative(): bool;

    /**
     * Get disabled
     *
     * @return bool
     */
    public function getDisabled(): bool;

    /**
     * Get createdAt
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface;

    /**
     * Get company
     *
     * @return Company | null
     */
    public function getCompany(): ?Company;

    /**
     * Get carrier
     *
     * @return Carrier | null
     */
    public function getCarrier(): ?Carrier;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
