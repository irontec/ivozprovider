<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Doctrine\ORM\Query\Expr\OrderBy;

interface UsersCdrRepository extends ObjectRepository, Selectable
{
    /**
     * @param mixed $userId
     * @return int
     */
    public function countByUserId($userId): int;

    /**
     * * @param int $userId
     */
    public function countInboundCallsInLastMonthByUser(int $userId): int;
        /**
     * * @param int $userId
     */
    public function countOutboundCallsInLastMonthByUser(int $userId): int;

    /**
     * This method expects results to be marked as parsed as soon as they're used:
     * a.k.a it does not apply any query offset, just a limit
     *
     * @param array<string, string>|array<array-key, OrderBy> $order
     * @return \Generator<array<UsersCdrInterface>>
     */
    public function getUnparsedCallsGeneratorWithoutOffset(int $batchSize, array $order = null): \Generator;
}
