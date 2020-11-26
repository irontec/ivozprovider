<?php

namespace Ivoz\Provider\Domain\Model\Service;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
* ServiceDtoAbstract
* @codeCoverageIgnore
*/
abstract class ServiceDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $iden = '';

    /**
     * @var string
     */
    private $defaultCode;

    /**
     * @var bool
     */
    private $extraArgs = false;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nameEn = '';

    /**
     * @var string
     */
    private $nameEs = '';

    /**
     * @var string
     */
    private $nameCa = '';

    /**
     * @var string
     */
    private $nameIt = '';

    /**
     * @var string
     */
    private $descriptionEn = '';

    /**
     * @var string
     */
    private $descriptionEs = '';

    /**
     * @var string
     */
    private $descriptionCa = '';

    /**
     * @var string
     */
    private $descriptionIt = '';

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
            'defaultCode' => 'defaultCode',
            'extraArgs' => 'extraArgs',
            'id' => 'id',
            'name' => [
                'en',
                'es',
                'ca',
                'it',
            ],
            'description' => [
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
            'defaultCode' => $this->getDefaultCode(),
            'extraArgs' => $this->getExtraArgs(),
            'id' => $this->getId(),
            'name' => [
                'en' => $this->getNameEn(),
                'es' => $this->getNameEs(),
                'ca' => $this->getNameCa(),
                'it' => $this->getNameIt(),
            ],
            'description' => [
                'en' => $this->getDescriptionEn(),
                'es' => $this->getDescriptionEs(),
                'ca' => $this->getDescriptionCa(),
                'it' => $this->getDescriptionIt(),
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
     * @param string $defaultCode | null
     *
     * @return static
     */
    public function setDefaultCode(?string $defaultCode = null): self
    {
        $this->defaultCode = $defaultCode;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDefaultCode(): ?string
    {
        return $this->defaultCode;
    }

    /**
     * @param bool $extraArgs | null
     *
     * @return static
     */
    public function setExtraArgs(?bool $extraArgs = null): self
    {
        $this->extraArgs = $extraArgs;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getExtraArgs(): ?bool
    {
        return $this->extraArgs;
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

    /**
     * @param string $descriptionEn | null
     *
     * @return static
     */
    public function setDescriptionEn(?string $descriptionEn = null): self
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    /**
     * @param string $descriptionEs | null
     *
     * @return static
     */
    public function setDescriptionEs(?string $descriptionEs = null): self
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionEs(): ?string
    {
        return $this->descriptionEs;
    }

    /**
     * @param string $descriptionCa | null
     *
     * @return static
     */
    public function setDescriptionCa(?string $descriptionCa = null): self
    {
        $this->descriptionCa = $descriptionCa;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionCa(): ?string
    {
        return $this->descriptionCa;
    }

    /**
     * @param string $descriptionIt | null
     *
     * @return static
     */
    public function setDescriptionIt(?string $descriptionIt = null): self
    {
        $this->descriptionIt = $descriptionIt;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescriptionIt(): ?string
    {
        return $this->descriptionIt;
    }

}
