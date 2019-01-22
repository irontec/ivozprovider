<?php

namespace Ivoz\Kam\Domain\Model\TrunksCdr;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TrunksCdrRepository extends ObjectRepository, Selectable
{
    /**
     * This method expects results to be marked as parsed as soon as they're used:
     * a.k.a it does not apply any query offset, just a limit
     *
     * @param int $batchSize
     * @param array|null $order
     * @return \Generator
     */
    public function getUnparsedCallsGeneratorWithoutOffset(int $batchSize, array $order = null);

    /**
     * @param array $ids
     * @return mixed
     */
    public function resetParsed(array $ids);

    /**
     * @param $callid
     * @return TrunksCdrInterface[]
     */
    public function findByCallid($callid);

    /**
     * @param $callid
     * @return TrunksCdrInterface | null
     */
    public function findOneByCallid($callid);
}
