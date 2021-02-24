<?php

namespace Ivoz\Provider\Domain\Model\BannedAddress;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Get ip
     *
     * @return string | null
     */
    public function getIp(): ?string;

    /**
     * Get blocker
     *
     * @return string | null
     */
    public function getBlocker(): ?string;

    /**
     * Get aor
     *
     * @return string | null
     */
    public function getAor(): ?string;

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription(): ?string;

    /**
     * Get lastTimeBanned
     *
     * @return \DateTimeInterface | null
     */
    public function getLastTimeBanned(): ?\DateTimeInterface;

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface;

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
