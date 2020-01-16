<?php

namespace Ivoz\Provider\Domain\Model\PublicEntity;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class PublicEntityDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $iden;

    /**
     * @var string
     */
    private $fqdn;

    /**
     * @var boolean
     */
    private $platform = false;

    /**
     * @var boolean
     */
    private $brand = false;

    /**
     * @var boolean
     */
    private $client = false;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nameEn;

    /**
     * @var string
     */
    private $nameEs;

    /**
     * @var string
     */
    private $nameCa;

    /**
     * @var string
     */
    private $nameIt;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'iden' => 'iden',
            'fqdn' => 'fqdn',
            'platform' => 'platform',
            'brand' => 'brand',
            'client' => 'client',
            'id' => 'id',
            'name' => ['en','es','ca','it']
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'iden' => $this->getIden(),
            'fqdn' => $this->getFqdn(),
            'platform' => $this->getPlatform(),
            'brand' => $this->getBrand(),
            'client' => $this->getClient(),
            'id' => $this->getId(),
            'name' => [
                'en' => $this->getNameEn(),
                'es' => $this->getNameEs(),
                'ca' => $this->getNameCa(),
                'it' => $this->getNameIt()
            ]
        ];
    }

    /**
     * @param string $iden
     *
     * @return static
     */
    public function setIden($iden = null)
    {
        $this->iden = $iden;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getIden()
    {
        return $this->iden;
    }

    /**
     * @param string $fqdn
     *
     * @return static
     */
    public function setFqdn($fqdn = null)
    {
        $this->fqdn = $fqdn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFqdn()
    {
        return $this->fqdn;
    }

    /**
     * @param boolean $platform
     *
     * @return static
     */
    public function setPlatform($platform = null)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param boolean $brand
     *
     * @return static
     */
    public function setBrand($brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param boolean $client
     *
     * @return static
     */
    public function setClient($client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $nameEn
     *
     * @return static
     */
    public function setNameEn($nameEn = null)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEs
     *
     * @return static
     */
    public function setNameEs($nameEs = null)
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEs()
    {
        return $this->nameEs;
    }

    /**
     * @param string $nameCa
     *
     * @return static
     */
    public function setNameCa($nameCa = null)
    {
        $this->nameCa = $nameCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameCa()
    {
        return $this->nameCa;
    }

    /**
     * @param string $nameIt
     *
     * @return static
     */
    public function setNameIt($nameIt = null)
    {
        $this->nameIt = $nameIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameIt()
    {
        return $this->nameIt;
    }
}
