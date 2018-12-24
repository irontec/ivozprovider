<?php

namespace Ivoz\Provider\Domain\Model\BrandUrl;

use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface BrandUrlInterface extends FileContainerInterface, LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return array
     */
    public function getFileObjects();

    /**
     * {@inheritDoc}
     */
    public function setUrl($url);

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl();

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
    public function getUrlType();

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
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set logo
     *
     * @param \Ivoz\Provider\Domain\Model\BrandUrl\Logo $logo
     *
     * @return self
     */
    public function setLogo(\Ivoz\Provider\Domain\Model\BrandUrl\Logo $logo);

    /**
     * Get logo
     *
     * @return \Ivoz\Provider\Domain\Model\BrandUrl\Logo
     */
    public function getLogo();

    /**
     * @param $fldName
     * @param TempFile $file
     */
    public function addTmpFile($fldName, \Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @param TempFile $file
     * @throws \Exception
     */
    public function removeTmpFile(\Ivoz\Core\Domain\Service\TempFile $file);

    /**
     * @return TempFile[]
     */
    public function getTempFiles();

    /**
     * @var string $fldName
     * @return null | TempFile
     */
    public function getTempFileByFieldName($fldName);
}
