<?php

namespace Ivoz\Provider\Domain\Model\TerminalModel;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TerminalModelDtoAbstract implements DataTransferObjectInterface
{
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
     * @var string
     */
    private $genericTemplate;

    /**
     * @var string
     */
    private $specificTemplate;

    /**
     * @var string
     */
    private $genericUrlPattern;

    /**
     * @var string
     */
    private $specificUrlPattern;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerDto | null
     */
    private $terminalManufacturer;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
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
        return [
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
     * @return string
     */
    public function getIden()
    {
        return $this->iden;
    }

    /**
     * @param string $name
     *
     * @return static
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
     * @param string $description
     *
     * @return static
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $genericTemplate
     *
     * @return static
     */
    public function setGenericTemplate($genericTemplate = null)
    {
        $this->genericTemplate = $genericTemplate;

        return $this;
    }

    /**
     * @return string
     */
    public function getGenericTemplate()
    {
        return $this->genericTemplate;
    }

    /**
     * @param string $specificTemplate
     *
     * @return static
     */
    public function setSpecificTemplate($specificTemplate = null)
    {
        $this->specificTemplate = $specificTemplate;

        return $this;
    }

    /**
     * @return string
     */
    public function getSpecificTemplate()
    {
        return $this->specificTemplate;
    }

    /**
     * @param string $genericUrlPattern
     *
     * @return static
     */
    public function setGenericUrlPattern($genericUrlPattern = null)
    {
        $this->genericUrlPattern = $genericUrlPattern;

        return $this;
    }

    /**
     * @return string
     */
    public function getGenericUrlPattern()
    {
        return $this->genericUrlPattern;
    }

    /**
     * @param string $specificUrlPattern
     *
     * @return static
     */
    public function setSpecificUrlPattern($specificUrlPattern = null)
    {
        $this->specificUrlPattern = $specificUrlPattern;

        return $this;
    }

    /**
     * @return string
     */
    public function getSpecificUrlPattern()
    {
        return $this->specificUrlPattern;
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
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerDto $terminalManufacturer
     *
     * @return static
     */
    public function setTerminalManufacturer(\Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerDto $terminalManufacturer = null)
    {
        $this->terminalManufacturer = $terminalManufacturer;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerDto
     */
    public function getTerminalManufacturer()
    {
        return $this->terminalManufacturer;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTerminalManufacturerId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerDto($id)
            : null;

        return $this->setTerminalManufacturer($value);
    }

    /**
     * @return integer | null
     */
    public function getTerminalManufacturerId()
    {
        if ($dto = $this->getTerminalManufacturer()) {
            return $dto->getId();
        }

        return null;
    }
}
