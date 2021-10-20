<?php

namespace Ivoz\Cgr\Domain\Model\TpAccountAction;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

/**
* TpAccountActionInterface
*/
interface TpAccountActionInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function getTpid(): string;

    public function getLoadid(): string;

    public function getTenant(): string;

    public function getAccount(): string;

    public function getActionPlanTag(): ?string;

    public function getActionTriggersTag(): ?string;

    public function getAllowNegative(): bool;

    public function getDisabled(): bool;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeInterface;

    public function getCompany(): ?CompanyInterface;

    public function getCarrier(): ?CarrierInterface;

    public function isInitialized(): bool;
}
