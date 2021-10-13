<?php

namespace Ivoz\Provider\Domain\Model\BannedAddress;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* BannedAddressInterface
*/
interface BannedAddressInterface extends LoggableEntityInterface
{
    public const BLOCKER_ANTIFLOOD = 'antiflood';

    public const BLOCKER_IPFILTER = 'ipfilter';

    public const BLOCKER_ANTIBRUTEFORCE = 'antibruteforce';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    public function getIp(): ?string;

    public function getBlocker(): ?string;

    public function getAor(): ?string;

    public function getDescription(): ?string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getLastTimeBanned(): ?\DateTimeInterface;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

    public function isInitialized(): bool;
}
