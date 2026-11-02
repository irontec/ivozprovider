<?php

namespace Ivoz\Ast\Domain\Model\VoicemailMessage;

use Generator;

interface VoicemailMessageRepository
{
    /**
     * Walks unparsed messages by ascending id, so it always ends even if
     * some results are never marked as parsed
     *
     * @param int $batchSize
     * @return Generator<VoicemailMessage[]>
     * @see VoicemailMessageDoctrineRepository::getUnparsedMessagesGeneratorWithoutOffset
     */
    public function getUnparsedMessagesGeneratorWithoutOffset(int $batchSize): Generator;
}
