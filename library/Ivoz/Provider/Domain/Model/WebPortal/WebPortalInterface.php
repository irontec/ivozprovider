<?php

namespace Ivoz\Provider\Domain\Model\WebPortal;

use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface WebPortalInterface extends FileContainerInterface, LoggableEntityInterface
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
    public function setUrl($url);

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
    public function getKlearTheme();

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
    public function getName();

    /**
     * Get userTheme
     *
     * @return string | null
     */
    public function getUserTheme();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand | null
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Get logo
     *
     * @return \Ivoz\Provider\Domain\Model\WebPortal\Logo
     */
    public function getLogo();

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @return void
     */
    public function addTmpFile(string $fldName, \Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @throws \Exception
     *
     * @return void
     */
    public function removeTmpFile(\Ivoz\Core\Domain\Service\TempFile $file);

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
