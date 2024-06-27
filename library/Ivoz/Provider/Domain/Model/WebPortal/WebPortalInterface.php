<?php

namespace Ivoz\Provider\Domain\Model\WebPortal;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Service\TempFile;

/**
* WebPortalInterface
*/
interface WebPortalInterface extends LoggableEntityInterface, FileContainerInterface
{
    public const URLTYPE_GOD = 'god';

    public const URLTYPE_BRAND = 'brand';

    public const URLTYPE_ADMIN = 'admin';

    public const URLTYPE_USER = 'user';

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

    /**
     * @return static
     */
    public function setUrl(string $url): static;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): WebPortalDto;

    /**
     * @internal use EntityTools instead
     * @param null|WebPortalInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?WebPortalDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param WebPortalDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): WebPortalDto;

    public function getUrl(): string;

    public function getUrlType(): string;

    public function getName(): ?string;

    public function getColor(): string;

    public function getLogo(): Logo;

    public function setBrand(?BrandInterface $brand = null): static;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

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
     * @param string $fldName
     * @return null | \Ivoz\Core\Domain\Service\TempFile
     */
    public function getTempFileByFieldName($fldName);
}
