<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* VoicemailInterface
*/
interface VoicemailInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): VoicemailDto;

    /**
     * @internal use EntityTools instead
     * @param null|VoicemailInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?VoicemailDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param VoicemailDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): VoicemailDto;

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

    public function setVoicemail(?\Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface $voicemail = null): static;

    public function getVoicemail(): ?\Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;

    public function isInitialized(): bool;
}
