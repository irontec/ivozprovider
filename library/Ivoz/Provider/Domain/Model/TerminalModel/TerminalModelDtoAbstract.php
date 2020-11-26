<?php

namespace Ivoz\Provider\Domain\Model\TerminalModel;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerDto;

/**
* TerminalModelDtoAbstract
* @codeCoverageIgnore
*/
abstract class TerminalModelDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $iden;

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var string | null
     */
    private $genericTemplate;

    /**
     * @var string | null
     */
    private $specificTemplate;

    /**
     * @var string | null
     */
    private $genericUrlPattern;

    /**
     * @var string | null
     */
    private $specificUrlPattern;

    /**
     * @var int
     */
    private $id;

    /**
     * @var TerminalManufacturerDto | null
     */
    private $terminalManufacturer;

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
            'name' => 'name',
            'description' => 'description',
            'genericTemplate' => 'genericTemplate',
            'specificTemplate' => 'specificTemplate',
            'genericUrlPattern' => 'genericUrlPattern',
            'specificUrlPattern' => 'specificUrlPattern',
            'id' => 'id',
            'terminalManufacturerId' => 'terminalManufacturer'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'iden' => $this->getIden(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'genericTemplate' => $this->getGenericTemplate(),
            'specificTemplate' => $this->getSpecificTemplate(),
            'genericUrlPattern' => $this->getGenericUrlPattern(),
            'specificUrlPattern' => $this->getSpecificUrlPattern(),
            'id' => $this->getId(),
            'terminalManufacturer' => $this->getTerminalManufacturer()
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
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $description | null
     *
     * @return static
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $genericTemplate | null
     *
     * @return static
     */
    public function setGenericTemplate(?string $genericTemplate = null): self
    {
        $this->genericTemplate = $genericTemplate;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getGenericTemplate(): ?string
    {
        return $this->genericTemplate;
    }

    /**
     * @param string $specificTemplate | null
     *
     * @return static
     */
    public function setSpecificTemplate(?string $specificTemplate = null): self
    {
        $this->specificTemplate = $specificTemplate;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSpecificTemplate(): ?string
    {
        return $this->specificTemplate;
    }

    /**
     * @param string $genericUrlPattern | null
     *
     * @return static
     */
    public function setGenericUrlPattern(?string $genericUrlPattern = null): self
    {
        $this->genericUrlPattern = $genericUrlPattern;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getGenericUrlPattern(): ?string
    {
        return $this->genericUrlPattern;
    }

    /**
     * @param string $specificUrlPattern | null
     *
     * @return static
     */
    public function setSpecificUrlPattern(?string $specificUrlPattern = null): self
    {
        $this->specificUrlPattern = $specificUrlPattern;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSpecificUrlPattern(): ?string
    {
        return $this->specificUrlPattern;
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
     * @param TerminalManufacturerDto | null
     *
     * @return static
     */
    public function setTerminalManufacturer(?TerminalManufacturerDto $terminalManufacturer = null): self
    {
        $this->terminalManufacturer = $terminalManufacturer;

        return $this;
    }

    /**
     * @return TerminalManufacturerDto | null
     */
    public function getTerminalManufacturer(): ?TerminalManufacturerDto
    {
        return $this->terminalManufacturer;
    }

    /**
     * @return static
     */
    public function setTerminalManufacturerId($id): self
    {
        $value = !is_null($id)
            ? new TerminalManufacturerDto($id)
            : null;

        return $this->setTerminalManufacturer($value);
    }

    /**
     * @return mixed | null
     */
    public function getTerminalManufacturerId()
    {
        if ($dto = $this->getTerminalManufacturer()) {
            return $dto->getId();
        }

        return null;
    }

}
