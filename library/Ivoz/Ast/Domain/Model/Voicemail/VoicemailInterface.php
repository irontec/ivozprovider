<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;

/**
* VoicemailInterface
*/
interface VoicemailInterface extends LoggableEntityInterface
{
    /**
     * @return array
     */
    public function getChangeSet();

    public function getContext(): string;

    public function getMailbox(): string;

    public function getPassword(): ?string;

    public function getFullname(): ?string;

    public function getAlias(): ?string;

    public function getEmail(): ?string;

    public function getPager(): ?string;

    public function getAttach(): ?string;

    public function getAttachfmt(): ?string;

    public function getServeremail(): ?string;

    public function getLanguage(): ?string;

    public function getTz(): ?string;

    public function getDeleteVoicemail(): ?string;

    public function getSaycid(): ?string;

    public function getSendVoicemail(): ?string;

    public function getReview(): ?string;

    public function getTempgreetwarn(): ?string;

    public function getOperator(): ?string;

    public function getEnvelope(): ?string;

    public function getSayduration(): ?int;

    public function getForcename(): ?string;

    public function getForcegreetings(): ?string;

    public function getCallback(): ?string;

    public function getDialout(): ?string;

    public function getExitcontext(): ?string;

    public function getMaxmsg(): ?int;

    public function getVolgain(): ?float;

    public function getImapuser(): ?string;

    public function getImappassword(): ?string;

    public function getImapserver(): ?string;

    public function getImapport(): ?string;

    public function getImapflags(): ?string;

    public function getStamp(): ?\DateTime;

    public function getUser(): ?UserInterface;

    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    public function isInitialized(): bool;
}
