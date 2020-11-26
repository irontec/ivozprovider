<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* VoicemailInterface
*/
interface VoicemailInterface extends LoggableEntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    /**
     * Get context
     *
     * @return string
     */
    public function getContext(): string;

    /**
     * Get mailbox
     *
     * @return string
     */
    public function getMailbox(): string;

    /**
     * Get password
     *
     * @return string | null
     */
    public function getPassword(): ?string;

    /**
     * Get fullname
     *
     * @return string | null
     */
    public function getFullname(): ?string;

    /**
     * Get alias
     *
     * @return string | null
     */
    public function getAlias(): ?string;

    /**
     * Get email
     *
     * @return string | null
     */
    public function getEmail(): ?string;

    /**
     * Get pager
     *
     * @return string | null
     */
    public function getPager(): ?string;

    /**
     * Get attach
     *
     * @return string | null
     */
    public function getAttach(): ?string;

    /**
     * Get attachfmt
     *
     * @return string | null
     */
    public function getAttachfmt(): ?string;

    /**
     * Get serveremail
     *
     * @return string | null
     */
    public function getServeremail(): ?string;

    /**
     * Get language
     *
     * @return string | null
     */
    public function getLanguage(): ?string;

    /**
     * Get tz
     *
     * @return string | null
     */
    public function getTz(): ?string;

    /**
     * Get deleteVoicemail
     *
     * @return string | null
     */
    public function getDeleteVoicemail(): ?string;

    /**
     * Get saycid
     *
     * @return string | null
     */
    public function getSaycid(): ?string;

    /**
     * Get sendVoicemail
     *
     * @return string | null
     */
    public function getSendVoicemail(): ?string;

    /**
     * Get review
     *
     * @return string | null
     */
    public function getReview(): ?string;

    /**
     * Get tempgreetwarn
     *
     * @return string | null
     */
    public function getTempgreetwarn(): ?string;

    /**
     * Get operator
     *
     * @return string | null
     */
    public function getOperator(): ?string;

    /**
     * Get envelope
     *
     * @return string | null
     */
    public function getEnvelope(): ?string;

    /**
     * Get sayduration
     *
     * @return int | null
     */
    public function getSayduration(): ?int;

    /**
     * Get forcename
     *
     * @return string | null
     */
    public function getForcename(): ?string;

    /**
     * Get forcegreetings
     *
     * @return string | null
     */
    public function getForcegreetings(): ?string;

    /**
     * Get callback
     *
     * @return string | null
     */
    public function getCallback(): ?string;

    /**
     * Get dialout
     *
     * @return string | null
     */
    public function getDialout(): ?string;

    /**
     * Get exitcontext
     *
     * @return string | null
     */
    public function getExitcontext(): ?string;

    /**
     * Get maxmsg
     *
     * @return int | null
     */
    public function getMaxmsg(): ?int;

    /**
     * Get volgain
     *
     * @return float | null
     */
    public function getVolgain(): ?float;

    /**
     * Get imapuser
     *
     * @return string | null
     */
    public function getImapuser(): ?string;

    /**
     * Get imappassword
     *
     * @return string | null
     */
    public function getImappassword(): ?string;

    /**
     * Get imapserver
     *
     * @return string | null
     */
    public function getImapserver(): ?string;

    /**
     * Get imapport
     *
     * @return string | null
     */
    public function getImapport(): ?string;

    /**
     * Get imapflags
     *
     * @return string | null
     */
    public function getImapflags(): ?string;

    /**
     * Get stamp
     *
     * @return \DateTimeInterface | null
     */
    public function getStamp(): ?\DateTimeInterface;

    /**
     * Get user
     *
     * @return UserInterface | null
     */
    public function getUser(): ?UserInterface;

    /**
     * Get residentialDevice
     *
     * @return ResidentialDeviceInterface | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
