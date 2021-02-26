<?php

namespace Ivoz\Cgr\Domain\Model\TpCdrStat;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

/**
* TpCdrStatInterface
*/
interface TpCdrStatInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getTpid(): string;

    public function getTag(): string;

    public function getQueueLength(): int;

    public function getTimeWindow(): string;

    public function getSaveInterval(): string;

    public function getMetrics(): string;

    public function getSetupInterval(): string;

    public function getTors(): string;

    public function getCdrHosts(): string;

    public function getCdrSources(): string;

    public function getReqTypes(): string;

    public function getDirections(): string;

    public function getTenants(): string;

    public function getCategories(): string;

    public function getAccounts(): string;

    public function getSubjects(): string;

    public function getDestinationIds(): string;

    public function getPpdInterval(): string;

    public function getUsageInterval(): string;

    public function getSuppliers(): string;

    public function getDisconnectCauses(): string;

    public function getMediationRunids(): string;

    public function getRatedAccounts(): string;

    public function getRatedSubjects(): string;

    public function getCostInterval(): string;

    public function getActionTriggers(): string;

    public function getCreatedAt(): \DateTime;

    public function setCarrier(CarrierInterface $carrier): static;

    public function getCarrier(): CarrierInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
