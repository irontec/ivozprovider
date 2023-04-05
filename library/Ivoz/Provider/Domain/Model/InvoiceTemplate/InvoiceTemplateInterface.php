<?php

namespace Ivoz\Provider\Domain\Model\InvoiceTemplate;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

/**
* InvoiceTemplateInterface
*/
interface InvoiceTemplateInterface extends LoggableEntityInterface
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

    /**
     * @inheritdoc
     */
    public function setTemplate(string $template): static;

    public static function createDto(string|int|null $id = null): InvoiceTemplateDto;

    /**
     * @internal use EntityTools instead
     * @param null|InvoiceTemplateInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?InvoiceTemplateDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param InvoiceTemplateDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): InvoiceTemplateDto;

    public function getName(): string;

    public function getDescription(): ?string;

    public function getTemplate(): string;

    public function getTemplateHeader(): ?string;

    public function getTemplateFooter(): ?string;

    public function getBrand(): ?BrandInterface;
}
