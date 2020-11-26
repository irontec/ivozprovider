<?php

namespace Ivoz\Provider\Domain\Model\TerminalModel;

use Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* TerminalModelInterface
*/
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
    public function setIden(string $iden): TerminalModelInterface;

    /**
     * {@inheritdoc}
     */
    public function setGenericTemplate(string $genericTemplate = null): TerminalModelInterface;

    /**
     * {@inheritdoc}
     */
    public function setSpecificTemplate(string $specificTemplate = null): TerminalModelInterface;

    /**
     * Get iden
     *
     * @return string
     */
    public function getIden(): string;

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get genericTemplate
     *
     * @return string | null
     */
    public function getGenericTemplate(): ?string;

    /**
     * Get specificTemplate
     *
     * @return string | null
     */
    public function getSpecificTemplate(): ?string;

    /**
     * Get genericUrlPattern
     *
     * @return string | null
     */
    public function getGenericUrlPattern(): ?string;

    /**
     * Get specificUrlPattern
     *
     * @return string | null
     */
    public function getSpecificUrlPattern(): ?string;

    /**
     * Get terminalManufacturer
     *
     * @return TerminalManufacturerInterface
     */
    public function getTerminalManufacturer(): TerminalManufacturerInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
