<?php

namespace Ivoz\Provider\Domain\Model\Voicemail;

/**
 * Voicemail
 */
class Voicemail extends VoicemailAbstract implements VoicemailInterface
{
    use VoicemailTrait;

    const VOICEMAIL_TYPE_USER = "user";
    const VOICEMAIL_TYPE_RESIDENTIAL = "residential";
    const VOICEMAIL_TYPE_GENERIC = "generic";

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string with the voicemail type
     */
    public function getType()
    {
        $user = $this->getUser();
        if ($user) {
            return self::VOICEMAIL_TYPE_USER;
        }

        $residentialDevice = $this->getResidentialDevice();
        if ($residentialDevice) {
            return self::VOICEMAIL_TYPE_RESIDENTIAL;
        }

        return self::VOICEMAIL_TYPE_GENERIC;
    }

    /**
     * @return string with the voicemail user@context
     */
    public function getVoicemailName()
    {
        return $this->getMailbox() . '@' . $this->getContext();
    }

    /**
     * @return string with the voicemail user
     */
    public function getMailbox()
    {
        $type = $this->getType();

        if ($type == self::VOICEMAIL_TYPE_USER) {
            return self::VOICEMAIL_TYPE_USER . $this->getUser()->getId();
        }

        if ($type == self::VOICEMAIL_TYPE_RESIDENTIAL) {
            return self::VOICEMAIL_TYPE_RESIDENTIAL . $this->getResidentialDevice()->getId();
        }

        return self::VOICEMAIL_TYPE_GENERIC . $this->getId();
    }

    /**
     * @return string with the voicemail context
     */
    public function getContext()
    {
        return
            'company'
            . $this->getCompany()->getId();
    }

}
