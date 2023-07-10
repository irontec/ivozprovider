<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface UsersCdrRepository extends ObjectRepository, Selectable
{
    /**
     * @param mixed $userId
     * @return int
     */
    public function countByUserId($userId): int;

    /**
     * @param string $callid
     * @return UsersCdrInterface[]
     */
    public function findByCallid($callid);

    /**
     * @param string $callid
     * @return UsersCdrInterface | null
     */
    public function findOneByCallid($callid);

    /**
     * * @param int $userId
     */
    public function countInboundCallsInLastMonthByUser(int $userId): int;
        /**
     * * @param int $userId
     */
    public function countOutboundCallsInLastMonthByUser(int $userId): int;
}
