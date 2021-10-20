<?php

namespace Ivoz\Provider\Domain\Model\WebPortal;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
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
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * @return array
     */
    public function getFileObjects(?int $filter = null): array;

    /**
     * @return static
     */
    public function setUrl(string $url): static;

    public function getUrl(): string;

    public function getKlearTheme(): ?string;

    public function getUrlType(): string;

    public function getName(): ?string;

    public function getUserTheme(): ?string;

    public function getLogo(): Logo;

    public function setBrand(?BrandInterface $brand = null): static;

    public function getBrand(): ?BrandInterface;

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
