<?php

namespace Ivoz\Provider\Domain\Model\Webhook;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

/**
* WebhookInterface
*/
interface WebhookInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): ?int;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): WebhookDto;

    /**
     * @internal use EntityTools instead
     * @param null|WebhookInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?WebhookDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param WebhookDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): WebhookDto;

    public function getName(): string;

    public function getDescription(): ?string;

    public function getUri(): string;

    public function getEventStart(): bool;

    public function getEventRing(): bool;

    public function getEventAnswer(): bool;

    public function getEventEnd(): bool;

    public function getTemplate(): string;

    public function getBrand(): BrandInterface;

    public function getCompany(): ?CompanyInterface;

    public function getDdi(): ?DdiInterface;
}
