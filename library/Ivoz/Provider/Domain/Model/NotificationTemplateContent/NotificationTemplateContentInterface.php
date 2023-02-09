<?php

namespace Ivoz\Provider\Domain\Model\NotificationTemplateContent;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;

/**
* NotificationTemplateContentInterface
*/
interface NotificationTemplateContentInterface extends LoggableEntityInterface
{
    public const BODYTYPE_TEXTPLAIN = 'text/plain';

    public const BODYTYPE_TEXTHTML = 'text/html';

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

    public static function createDto(string|int|null $id = null): NotificationTemplateContentDto;

    /**
     * @internal use EntityTools instead
     * @param null|NotificationTemplateContentInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?NotificationTemplateContentDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param NotificationTemplateContentDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): NotificationTemplateContentDto;

    public function getFromName(): ?string;

    public function getFromAddress(): ?string;

    public function getSubject(): string;

    public function getBody(): string;

    public function getBodyType(): string;

    public function setNotificationTemplate(NotificationTemplateInterface $notificationTemplate): static;

    public function getNotificationTemplate(): NotificationTemplateInterface;

    public function getLanguage(): ?LanguageInterface;

    public function isInitialized(): bool;
}
