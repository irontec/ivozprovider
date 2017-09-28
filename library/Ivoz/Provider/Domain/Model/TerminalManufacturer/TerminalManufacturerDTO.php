<?php

namespace Ivoz\Provider\Domain\Model\TerminalManufacturer;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class TerminalManufacturerDTO implements DataTransferObjectInterface
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
     * @var integer
     */
    private $id;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'iden' => $this->getIden(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'id' => $this->getId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {

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
     * @return TerminalManufacturerDTO
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
     * @return TerminalManufacturerDTO
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
     * @return TerminalManufacturerDTO
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
     * @param integer $id
     *
     * @return TerminalManufacturerDTO
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
}

