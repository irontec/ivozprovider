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
    const BLOCKER_ANTIFLOOD = 'antiflood';

    const BLOCKER_IPFILTER = 'ipfilter';

    const BLOCKER_ANTIBRUTEFORCE = 'antibruteforce';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function getIp(): ?string;

    public function getBlocker(): ?string;

    public function getAor(): ?string;

    public function getDescription(): ?string;

    public function getLastTimeBanned(): ?\DateTime;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
