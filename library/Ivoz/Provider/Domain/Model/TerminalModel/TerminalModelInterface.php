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

    /**
     * Get iden
     *
     * @return string
     */
    public function getIden();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get genericTemplate
     *
     * @return string | null
     */
    public function getGenericTemplate();

    /**
     * Get specificTemplate
     *
     * @return string | null
     */
    public function getSpecificTemplate();

    /**
     * Get genericUrlPattern
     *
     * @return string | null
     */
    public function getGenericUrlPattern();

    /**
     * Get specificUrlPattern
     *
     * @return string | null
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
