<?php

namespace Ivoz\Provider\Domain\Model\PublicEntity;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* PublicEntityDtoAbstract
* @codeCoverageIgnore
*/
abstract class PublicEntityDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $iden;

    /**
     * @var string | null
     */
    private $fqdn;

    /**
     * @var bool
     */
    private $platform = false;

    /**
     * @var bool
     */
    private $brand = false;

    /**
     * @var bool
     */
    private $client = false;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string | null
     */
    private $nameEn;

    /**
     * @var string | null
     */
    private $nameEs;

    /**
     * @var string | null
     */
    private $nameCa;

    /**
     * @var string | null
     */
    private $nameIt;

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
            'name' => [
                'en',
                'es',
                'ca',
                'it',
            ]
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
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
                'it' => $this->getNameIt(),
            ]
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param string $iden | null
     *
     * @return static
     */
    public function setIden(?string $iden = null): self
    {
        $this->iden = $iden;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getIden(): ?string
    {
        return $this->iden;
    }

    /**
     * @param string $fqdn | null
     *
     * @return static
     */
    public function setFqdn(?string $fqdn = null): self
    {
        $this->fqdn = $fqdn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFqdn(): ?string
    {
        return $this->fqdn;
    }

    /**
     * @param bool $platform | null
     *
     * @return static
     */
    public function setPlatform(?bool $platform = null): self
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getPlatform(): ?bool
    {
        return $this->platform;
    }

    /**
     * @param bool $brand | null
     *
     * @return static
     */
    public function setBrand(?bool $brand = null): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getBrand(): ?bool
    {
        return $this->brand;
    }

    /**
     * @param bool $client | null
     *
     * @return static
     */
    public function setClient(?bool $client = null): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getClient(): ?bool
    {
        return $this->client;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string $nameEn | null
     *
     * @return static
     */
    public function setNameEn(?string $nameEn = null): self
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEn(): ?string
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEs | null
     *
     * @return static
     */
    public function setNameEs(?string $nameEs = null): self
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameEs(): ?string
    {
        return $this->nameEs;
    }

    /**
     * @param string $nameCa | null
     *
     * @return static
     */
    public function setNameCa(?string $nameCa = null): self
    {
        $this->nameCa = $nameCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameCa(): ?string
    {
        return $this->nameCa;
    }

    /**
     * @param string $nameIt | null
     *
     * @return static
     */
    public function setNameIt(?string $nameIt = null): self
    {
        $this->nameIt = $nameIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNameIt(): ?string
    {
        return $this->nameIt;
    }

}
