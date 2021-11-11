<?php

namespace Ivoz\Provider\Domain\Model\MaxUsageNotification;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

/**
* MaxUsageNotificationInterface
*/
interface MaxUsageNotificationInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): MaxUsageNotificationDto;

    /**
     * @internal use EntityTools instead
     * @param null|MaxUsageNotificationInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?MaxUsageNotificationDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): MaxUsageNotificationDto;

    public function getToAddress(): ?string;

    public function getThreshold(): ?float;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getLastSent(): ?\DateTimeInterface;

    public function getNotificationTemplate(): ?NotificationTemplateInterface;

    public function getCompany(): ?CompanyInterface;

    public function isInitialized(): bool;
}
