<?php

namespace Ivoz\Provider\Domain\Model\VoicemailRelUser;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
* VoicemailRelUserInterface
*/
interface VoicemailRelUserInterface extends LoggableEntityInterface
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

    public function getVoicemail(): VoicemailInterface;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): VoicemailRelUserDto;

    /**
     * @internal use EntityTools instead
     * @param null|VoicemailRelUserInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?VoicemailRelUserDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param VoicemailRelUserDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): VoicemailRelUserDto;

    public function setUser(UserInterface $user): static;

    public function getUser(): UserInterface;

    public function setVoicemail(?VoicemailInterface $voicemail = null): static;
}
