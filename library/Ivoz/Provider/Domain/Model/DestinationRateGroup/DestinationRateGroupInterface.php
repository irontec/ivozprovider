<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* DestinationRateGroupInterface
*/
interface DestinationRateGroupInterface extends LoggableEntityInterface, FileContainerInterface
{
    public const STATUS_WAITING = 'waiting';

    public const STATUS_INPROGRESS = 'inProgress';

    public const STATUS_IMPORTED = 'imported';

    public const STATUS_ERROR = 'error';

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
     * @return array
     */
    public function getFileObjects(?int $filter = null): array;

    /**
     * Add TempFile and set status to pending
     *
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @return void
     */
    public function addTmpFile(string $fldName, TempFile $file);

    /**
     * @return string
     */
    public function getCgrTag(): string;

    /**
     * @return string
     */
    public function getCurrencySymbol(): string;

    /**
     * @return string
     */
    public function getCurrencyIden(): string;

    /**
     * @return string
     */
    public function getRoundingMethod();

    public static function createDto(string|int|null $id = null): DestinationRateGroupDto;

    /**
     * @internal use EntityTools instead
     * @param null|DestinationRateGroupInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DestinationRateGroupDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DestinationRateGroupDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DestinationRateGroupDto;

    public function getStatus(): ?string;

    public function getLastExecutionError(): ?string;

    public function getDeductibleConnectionFee(): bool;

    public function getName(): Name;

    public function getDescription(): Description;

    public function getFile(): File;

    public function getBrand(): BrandInterface;

    public function getCurrency(): ?CurrencyInterface;

    public function isInitialized(): bool;

    public function addDestinationRate(DestinationRateInterface $destinationRate): DestinationRateGroupInterface;

    public function removeDestinationRate(DestinationRateInterface $destinationRate): DestinationRateGroupInterface;

    /**
     * @param Collection<array-key, DestinationRateInterface> $destinationRates
     */
    public function replaceDestinationRates(Collection $destinationRates): DestinationRateGroupInterface;

    /**
     * @return array<array-key, DestinationRateInterface>
     */
    public function getDestinationRates(?Criteria $criteria = null): array;

    /**
     * @throws \Exception
     * @return void
     */
    public function removeTmpFile(TempFile $file);

    /**
     * @return \Ivoz\Core\Domain\Service\TempFile[]
     */
    public function getTempFiles();

    /**
     * @var string $fldName
     * @return null | \Ivoz\Core\Domain\Service\TempFile
     */
    public function getTempFileByFieldName($fldName);
}
