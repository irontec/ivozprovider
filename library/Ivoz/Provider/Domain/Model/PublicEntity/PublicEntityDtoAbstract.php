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
     * @var string|null
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
     * @var string|null
     */
    private $nameEn;

    /**
     * @var string|null
     */
    private $nameEs;

    /**
     * @var string|null
     */
    private $nameCa;

    /**
     * @var string|null
     */
    private $nameIt;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
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

    public function toArray(bool $hideSensitiveData = false): array
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

    public function setIden(string $iden): static
    {
        $this->iden = $iden;

        return $this;
    }

    public function getIden(): ?string
    {
        return $this->iden;
    }

    public function setFqdn(?string $fqdn): static
    {
        $this->fqdn = $fqdn;

        return $this;
    }

    public function getFqdn(): ?string
    {
        return $this->fqdn;
    }

    public function setPlatform(bool $platform): static
    {
        $this->platform = $platform;

        return $this;
    }

    public function getPlatform(): ?bool
    {
        return $this->platform;
    }

    public function setBrand(bool $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?bool
    {
        return $this->brand;
    }

    public function setClient(bool $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getClient(): ?bool
    {
        return $this->client;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNameEn(?string $nameEn): static
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    public function getNameEn(): ?string
    {
        return $this->nameEn;
    }

    public function setNameEs(?string $nameEs): static
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    public function getNameEs(): ?string
    {
        return $this->nameEs;
    }

    public function setNameCa(?string $nameCa): static
    {
        $this->nameCa = $nameCa;

        return $this;
    }

    public function getNameCa(): ?string
    {
        return $this->nameCa;
    }

    public function setNameIt(?string $nameIt): static
    {
        $this->nameIt = $nameIt;

        return $this;
    }

    public function getNameIt(): ?string
    {
        return $this->nameIt;
    }
}
