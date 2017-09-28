<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

/**
 * Voicemail
 */
class Voicemail extends VoicemailAbstract implements VoicemailInterface
{
    use VoicemailTrait;

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

