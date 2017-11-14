<?php

namespace Ivoz\Provider\Domain\Model\BrandUrl;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class BrandUrlDTO implements DataTransferObjectInterface
{
    use BrandUrlDTOTrait;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $klearTheme = '';

    /**
     * @var string
     */
    private $urlType;

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $userTheme = '';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $logoFileSize;

    /**
     * @var string
     */
    private $logoMimeType;

    /**
     * @var string
     */
    private $logoBaseName;

    /**
     * @var mixed
     */
    private $brandId;

    /**
     * @var mixed
     */
    private $brand;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'url' => $this->getUrl(),
            'klearTheme' => $this->getKlearTheme(),
            'urlType' => $this->getUrlType(),
            'name' => $this->getName(),
            'userTheme' => $this->getUserTheme(),
            'id' => $this->getId(),
            'logoFileSize' => $this->getLogoFileSize(),
            'logoMimeType' => $this->getLogoMimeType(),
            'logoBaseName' => $this->getLogoBaseName(),
            'brandId' => $this->getBrandId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $url
     *
     * @return BrandUrlDTO
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $klearTheme
     *
     * @return BrandUrlDTO
     */
    public function setKlearTheme($klearTheme = null)
    {
        $this->klearTheme = $klearTheme;

        return $this;
    }

    /**
     * @return string
     */
    public function getKlearTheme()
    {
        return $this->klearTheme;
    }

    /**
     * @param string $urlType
     *
     * @return BrandUrlDTO
     */
    public function setUrlType($urlType)
    {
        $this->urlType = $urlType;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrlType()
    {
        return $this->urlType;
    }

    /**
     * @param string $name
     *
     * @return BrandUrlDTO
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $userTheme
     *
     * @return BrandUrlDTO
     */
    public function setUserTheme($userTheme = null)
    {
        $this->userTheme = $userTheme;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserTheme()
    {
        return $this->userTheme;
    }

    /**
     * @param integer $id
     *
     * @return BrandUrlDTO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $logoFileSize
     *
     * @return BrandUrlDTO
     */
    public function setLogoFileSize($logoFileSize)
    {
        $this->logoFileSize = $logoFileSize;

        return $this;
    }

    /**
     * @return integer
     */
    public function getLogoFileSize()
    {
        return $this->logoFileSize;
    }

    /**
     * @param string $logoMimeType
     *
     * @return BrandUrlDTO
     */
    public function setLogoMimeType($logoMimeType)
    {
        $this->logoMimeType = $logoMimeType;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogoMimeType()
    {
        return $this->logoMimeType;
    }

    /**
     * @param string $logoBaseName
     *
     * @return BrandUrlDTO
     */
    public function setLogoBaseName($logoBaseName)
    {
        $this->logoBaseName = $logoBaseName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogoBaseName()
    {
        return $this->logoBaseName;
    }

    /**
     * @param integer $brandId
     *
     * @return BrandUrlDTO
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }
}


