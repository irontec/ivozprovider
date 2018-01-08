<?php

namespace Ivoz\Provider\Domain\Model\TerminalModel;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TerminalModelInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setIden($iden);

    /**
     * {@inheritdoc}
     */
    public function setGenericTemplate($genericTemplate = null);

    /**
     * {@inheritdoc}
     */
    public function setSpecificTemplate($specificTemplate = null);

    public function __toString();

    /**
     * Get iden
     *
     * @return string
     */
    public function getIden();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get genericTemplate
     *
     * @return string
     */
    public function getGenericTemplate();

    /**
     * Get specificTemplate
     *
     * @return string
     */
    public function getSpecificTemplate();

    /**
     * Set genericUrlPattern
     *
     * @param string $genericUrlPattern
     *
     * @return self
     */
    public function setGenericUrlPattern($genericUrlPattern = null);

    /**
     * Get genericUrlPattern
     *
     * @return string
     */
    public function getGenericUrlPattern();

    /**
     * Set specificUrlPattern
     *
     * @param string $specificUrlPattern
     *
     * @return self
     */
    public function setSpecificUrlPattern($specificUrlPattern = null);

    /**
     * Get specificUrlPattern
     *
     * @return string
     */
    public function getSpecificUrlPattern();

    /**
     * Set terminalManufacturer
     *
     * @param \Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerInterface $terminalManufacturer
     *
     * @return self
     */
    public function setTerminalManufacturer(\Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerInterface $terminalManufacturer);

    /**
     * Get terminalManufacturer
     *
     * @return \Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerInterface
     */
    public function getTerminalManufacturer();

}

