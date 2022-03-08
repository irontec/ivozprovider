<?php

namespace Ivoz\Provider\Domain\Model\Voicemail;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

/**
* VoicemailInterface
*/
interface VoicemailInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * @return string with the voicemail type
     */
    public function getType();

    /**
     * @return string with the voicemail user@context
     */
    public function getVoicemailName();

    /**
     * @return string with the voicemail user
     */
    public function getMailbox();

    /**
     * @return string with the voicemail context
     */
    public function getContext();

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

    public function getEnabled(): bool;

    public function getName(): string;

    public function getEmail(): ?string;

    public function getSendMail(): bool;

    public function getAttachSound(): bool;

    public function setUser(?UserInterface $user = null): static;

    public function getUser(): ?UserInterface;

    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): static;

    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    public function setCompany(CompanyInterface $company): static;

    public function getCompany(): CompanyInterface;

    public function getLocution(): ?LocutionInterface;

    public function isInitialized(): bool;

    public function setAstVoicemail(\Ivoz\Ast\Domain\Model\Voicemail\VoicemailInterface $astVoicemail): static;

    public function getAstVoicemail(): ?\Ivoz\Ast\Domain\Model\Voicemail\VoicemailInterface;
}
