<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface VoicemailRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $id
     * @return VoicemailInterface | null
     */
    public function findOneByUserId($id);

    /**
     * @param string $mailbox
     * @param string $context
     * @return VoicemailInterface
     */
    public function findByMailboxAndContext($mailbox, $context);
}
