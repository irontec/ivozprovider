<?php

namespace Ivoz\Cgr\Domain\Model\TpAccountAction;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;

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

    public function getTpid(): string;

    public function getLoadid(): string;

    public function getTenant(): string;

    public function getAccount(): string;

    public function getActionPlanTag(): ?string;

    public function getActionTriggersTag(): ?string;

    public function getAllowNegative(): bool;

    public function getDisabled(): bool;

    public function getCreatedAt(): \DateTime;

    public function getCompany(): ?Company;

    public function getCarrier(): ?Carrier;

    public function isInitialized(): bool;
}
