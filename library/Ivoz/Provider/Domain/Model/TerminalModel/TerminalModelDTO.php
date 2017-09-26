<?php

namespace Ivoz\Provider\Domain\Model\TerminalModel;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class TerminalModelDTO implements DataTransferObjectInterface
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
     * @var mixed
     */
    private $terminalManufacturerId;

    /**
     * @var mixed
     */
    private $terminalManufacturer;

    /**
     * @return array
     */
    public function __toArray()
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
            'terminalManufacturerId' => $this->getTerminalManufacturerId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->terminalManufacturer = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\TerminalManufacturer\\TerminalManufacturer', $this->getTerminalManufacturerId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $iden
     *
     * @return TerminalModelDTO
     */
    public function setIden($iden)
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
     * @return TerminalModelDTO
     */
    public function setName($name)
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
     * @return TerminalModelDTO
     */
    public function setDescription($description)
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
     * @return TerminalModelDTO
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
     * @return TerminalModelDTO
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
     * @return TerminalModelDTO
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
     * @return TerminalModelDTO
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
     * @return TerminalModelDTO
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
     * @param integer $terminalManufacturerId
     *
     * @return TerminalModelDTO
     */
    public function setTerminalManufacturerId($terminalManufacturerId)
    {
        $this->terminalManufacturerId = $terminalManufacturerId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTerminalManufacturerId()
    {
        return $this->terminalManufacturerId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturer
     */
    public function getTerminalManufacturer()
    {
        return $this->terminalManufacturer;
    }
}

