<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

/**
 * Voicemail
 */
class Voicemail extends VoicemailAbstract implements VoicemailInterface
{
    use VoicemailTrait;

    public function getChangeSet()
    {
        $changeSet = parent::getChangeSet();
        if (isset($changeSet['password'])) {
            $changeSet['password'] = '****';
        }

        if (isset($changeSet['imappassword'])) {
            $changeSet['imappassword'] = '****';
        }

        return $changeSet;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

