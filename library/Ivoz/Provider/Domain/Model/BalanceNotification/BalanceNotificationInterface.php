<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;

/**
* BalanceNotificationInterface
*/
interface BalanceNotificationInterface extends LoggableEntityInterface
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

    public function getLanguage(): LanguageInterface;

    /**
     * @return string
     */
    public function getEntityName();

    public static function createDto(string|int|null $id = null): BalanceNotificationDto;

    /**
     * @internal use EntityTools instead
     * @param null|BalanceNotificationInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?BalanceNotificationDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param BalanceNotificationDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): BalanceNotificationDto;

    public function getToAddress(): ?string;

    public function getThreshold(): ?float;

    public function getLastSent(): ?\DateTime;

    public function getCompany(): ?CompanyInterface;

    public function getCarrier(): ?CarrierInterface;

    public function getNotificationTemplate(): ?NotificationTemplateInterface;
}
