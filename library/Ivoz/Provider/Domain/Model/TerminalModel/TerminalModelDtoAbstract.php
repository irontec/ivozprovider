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
    private $iden = '';

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var string|null
     */
    private $genericTemplate;

    /**
     * @var string|null
     */
    private $specificTemplate;

    /**
     * @var string|null
     */
    private $genericUrlPattern;

    /**
     * @var string|null
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

    public function setIden(?string $iden): static
    {
        $this->iden = $iden;

        return $this;
    }

    public function getIden(): ?string
    {
        return $this->iden;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setGenericTemplate(?string $genericTemplate): static
    {
        $this->genericTemplate = $genericTemplate;

        return $this;
    }

    public function getGenericTemplate(): ?string
    {
        return $this->genericTemplate;
    }

    public function setSpecificTemplate(?string $specificTemplate): static
    {
        $this->specificTemplate = $specificTemplate;

        return $this;
    }

    public function getSpecificTemplate(): ?string
    {
        return $this->specificTemplate;
    }

    public function setGenericUrlPattern(?string $genericUrlPattern): static
    {
        $this->genericUrlPattern = $genericUrlPattern;

        return $this;
    }

    public function getGenericUrlPattern(): ?string
    {
        return $this->genericUrlPattern;
    }

    public function setSpecificUrlPattern(?string $specificUrlPattern): static
    {
        $this->specificUrlPattern = $specificUrlPattern;

        return $this;
    }

    public function getSpecificUrlPattern(): ?string
    {
        return $this->specificUrlPattern;
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

    public function setTerminalManufacturer(?TerminalManufacturerDto $terminalManufacturer): static
    {
        $this->terminalManufacturer = $terminalManufacturer;

        return $this;
    }

    public function getTerminalManufacturer(): ?TerminalManufacturerDto
    {
        return $this->terminalManufacturer;
    }

    public function setTerminalManufacturerId($id): static
    {
        $value = !is_null($id)
            ? new TerminalManufacturerDto($id)
            : null;

        return $this->setTerminalManufacturer($value);
    }

    public function getTerminalManufacturerId()
    {
        if ($dto = $this->getTerminalManufacturer()) {
            return $dto->getId();
        }

        return null;
    }

}
