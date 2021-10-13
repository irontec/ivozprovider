<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Assert\Assertion;

/**
* File
* @codeCoverageIgnore
*/
final class File
{
    /**
     * column: fileFileSize
     * comment: FSO
     */
    private $fileSize;

    /**
     * column: fileMimeType
     */
    private $mimeType;

    /**
     * column: fileBaseName
     */
    private $baseName;

    /**
     * column: fileImporterArguments
     */
    private $importerArguments = [];

    /**
     * Constructor
     */
    public function __construct(
        ?int $fileSize,
        ?string $mimeType,
        ?string $baseName,
        ?array $importerArguments
    ) {
        $this->setFileSize($fileSize);
        $this->setMimeType($mimeType);
        $this->setBaseName($baseName);
        $this->setImporterArguments($importerArguments);
    }

    /**
     * Equals
     */
    public function equals(self $file)
    {
        if ($this->getFileSize() !== $file->getFileSize()) {
            return false;
        }
        if ($this->getMimeType() !== $file->getMimeType()) {
            return false;
        }
        if ($this->getBaseName() !== $file->getBaseName()) {
            return false;
        }
        return $this->getImporterArguments() === $file->getImporterArguments();
    }

    protected function setFileSize(?int $fileSize = null): static
    {
        if (!is_null($fileSize)) {
            Assertion::greaterOrEqualThan($fileSize, 0, 'fileSize provided "%s" is not greater or equal than "%s".');
        }

        $this->fileSize = $fileSize;

        return $this;
    }

    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    protected function setMimeType(?string $mimeType = null): static
    {
        if (!is_null($mimeType)) {
            Assertion::maxLength($mimeType, 80, 'mimeType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->mimeType = $mimeType;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    protected function setBaseName(?string $baseName = null): static
    {
        if (!is_null($baseName)) {
            Assertion::maxLength($baseName, 255, 'baseName value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->baseName = $baseName;

        return $this;
    }

    public function getBaseName(): ?string
    {
        return $this->baseName;
    }

    protected function setImporterArguments(?array $importerArguments = null): static
    {
        $this->importerArguments = $importerArguments;

        return $this;
    }

    public function getImporterArguments(): ?array
    {
        return $this->importerArguments;
    }
}
