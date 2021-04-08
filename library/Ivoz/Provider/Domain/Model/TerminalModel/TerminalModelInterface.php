<?php

namespace Ivoz\Provider\Domain\Model\TerminalModel;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerInterface;

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
    public function setIden(string $iden): static;

    /**
     * {@inheritdoc}
     */
    public function setGenericTemplate(?string $genericTemplate = null): static;

    /**
     * {@inheritdoc}
     */
    public function setSpecificTemplate(?string $specificTemplate = null): static;

    public function getIden(): string;

    public function getName(): string;

    public function getDescription(): string;

    public function getGenericTemplate(): ?string;

    public function getSpecificTemplate(): ?string;

    public function getGenericUrlPattern(): ?string;

    public function getSpecificUrlPattern(): ?string;

    public function getTerminalManufacturer(): TerminalManufacturerInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
