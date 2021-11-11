<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use DateTimeInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Core\Domain\Service\TempFile;

/**
* FaxesInOutInterface
*/
interface FaxesInOutInterface extends LoggableEntityInterface, FileContainerInterface
{
    public const TYPE_IN = 'In';

    public const TYPE_OUT = 'Out';

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * @return array
     */
    public function getFileObjects(?int $filter = null): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public function setCalldate(DateTimeInterface $calldate = null): static;

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getDstE164();

    public static function createDto(string|int|null $id = null): FaxesInOutDto;

    /**
     * @internal use EntityTools instead
     * @param null|FaxesInOutInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FaxesInOutDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FaxesInOutDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FaxesInOutDto;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCalldate(): \DateTimeInterface;

    public function getSrc(): ?string;

    public function getDst(): ?string;

    public function getType(): ?string;

    public function getPages(): ?string;

    public function getStatus(): ?string;

    public function getFile(): File;

    public function getFax(): FaxInterface;

    public function getDstCountry(): ?CountryInterface;

    public function isInitialized(): bool;

    /**
     * @return void
     */
    public function addTmpFile(string $fldName, TempFile $file);

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
