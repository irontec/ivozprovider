<?php

namespace Ivoz\Cgr\Domain\Service\TpCdrStat;

use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;

interface FetchCallStatsServiceInterface
{
    /**
     * @param CarrierInterface $carrier
     * @return \stdClass
     */
    public function execute(CarrierInterface $carrier);

    /**
     * @param integer $carrierId
     * @return integer
     */
    public function getAsr(int $carrierId);

    /**
     * @param integer $carrierId
     * @return integer
     */
    public function getAcd(int $carrierId);
}
