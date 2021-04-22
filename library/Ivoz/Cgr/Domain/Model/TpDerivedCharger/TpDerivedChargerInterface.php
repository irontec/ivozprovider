<?php

namespace Ivoz\Cgr\Domain\Model\TpDerivedCharger;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;

/**
* TpDerivedChargerInterface
*/
interface TpDerivedChargerInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getTpid(): string;

    public function getLoadid(): string;

    public function getDirection(): string;

    public function getTenant(): string;

    public function getCategory(): string;

    public function getAccount(): string;

    public function getSubject(): ?string;

    public function getDestinationIds(): ?string;

    public function getRunid(): string;

    public function getRunFilters(): string;

    public function getReqTypeField(): string;

    public function getDirectionField(): string;

    public function getTenantField(): string;

    public function getCategoryField(): string;

    public function getAccountField(): string;

    public function getSubjectField(): string;

    public function getDestinationField(): string;

    public function getSetupTimeField(): string;

    public function getPddField(): string;

    public function getAnswerTimeField(): string;

    public function getUsageField(): string;

    public function getSupplierField(): string;

    public function getDisconnectCauseField(): string;

    public function getRatedTimeField(): string;

    public function getCostField(): string;

    public function getCreatedAt(): \DateTime;

    public function getBrand(): Brand;

    public function isInitialized(): bool;
}
