<?php

namespace Ivoz\Ast\Domain\Model\VoicemailMessage;

use Generator;

interface VoicemailMessageRepository
{
    /**
     * This method expects results to be marked as parsed as soon as they're used:
     * a.k.a it does not apply any query offset, just a limit
     *
     * @param int $batchSize
     * @param string[] $order
     * @return Generator<VoicemailMessage[]>
     * @see VoicemailMessageDoctrineRepository::getUnparsedMessagesGeneratorWithoutOffset
     */
    public function getUnparsedMessagesGeneratorWithoutOffset(int $batchSize, array $order = null): Generator;
}
