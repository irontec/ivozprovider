<?php

namespace Ivoz\Provider\Domain\Model\WebPortal;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
* WebPortalInterface
*/
interface WebPortalInterface extends LoggableEntityInterface, FileContainerInterface
{
    const URLTYPE_GOD = 'god';

    const URLTYPE_BRAND = 'brand';

    const URLTYPE_ADMIN = 'admin';

    const URLTYPE_USER = 'user';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return array
     */
    public function getFileObjects(int $filter = null);

    /**
     * {@inheritDoc}
     */
    public function setUrl(string $url): WebPortalInterface;

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * Get klearTheme
     *
     * @return string | null
     */
    public function getKlearTheme(): ?string;

    /**
     * Get urlType
     *
     * @return string
     */
    public function getUrlType(): string;

    /**
     * Get name
     *
     * @return string | null
     */
    public function getName(): ?string;

    /**
     * Get userTheme
     *
     * @return string | null
     */
    public function getUserTheme(): ?string;

    /**
     * Get logo
     *
     * @return Logo
     */
    public function getLogo(): Logo;

    /**
     * Set brand
     *
     * @param BrandInterface | null
     *
     * @return static
     */
    public function setBrand(?BrandInterface $brand = null): WebPortalInterface;

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface;

    /**
     * @return bool
     */
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
