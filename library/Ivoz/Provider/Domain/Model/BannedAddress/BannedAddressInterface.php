<?php

namespace Ivoz\Provider\Domain\Model\BannedAddress;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function getIp();

    /**
     * Get blocker
     *
     * @return string | null
     */
    public function getBlocker();

    /**
     * Get aor
     *
     * @return string | null
     */
    public function getAor();

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription();

    /**
     * Get lastTimeBanned
     *
     * @return \DateTime | null
     */
    public function getLastTimeBanned();

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
