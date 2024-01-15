<?php

namespace Ivoz\Provider\Domain\Model\UsersCdr;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;

/**
* UsersCdrInterface
*/
interface UsersCdrInterface extends LoggableEntityInterface
{
    public const DIRECTION_INBOUND = 'inbound';

    public const DIRECTION_OUTBOUND = 'outbound';

    public const DISPOSITION_ANSWERED = 'answered';

    public const DISPOSITION_MISSED = 'missed';

    public const DISPOSITION_BUSY = 'busy';

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

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): UsersCdrDto;

    /**
     * @internal use EntityTools instead
     * @param null|UsersCdrInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?UsersCdrDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersCdrDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UsersCdrDto;

    public function getStartTime(): ?\DateTime;

    public function getDuration(): float;

    public function getDirection(): ?string;

    public function getCaller(): ?string;

    public function getCallee(): ?string;

    public function getOwner(): ?string;

    public function getCallid(): ?string;

    public function getBrandId(): ?int;

    public function getDisposition(): ?string;

    public function getCompany(): ?CompanyInterface;

    public function getUser(): ?UserInterface;

    public function getFriend(): ?FriendInterface;

    public function getExtension(): ?ExtensionInterface;

    public function getKamUsersCdr(): ?\Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrInterface;
}
