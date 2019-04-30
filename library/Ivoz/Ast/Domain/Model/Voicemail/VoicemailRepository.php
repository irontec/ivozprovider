<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface VoicemailRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $id
     * @return VoicemailInterface
     */
    public function findOneByUserId($id);

    /**
     * @param string $mailbox
     * @param string $context
     * @return VoicemailInterface
     */
    public function findByMailboxAndContext($mailbox, $context);
}
