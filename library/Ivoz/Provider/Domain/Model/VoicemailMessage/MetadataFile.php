<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\VoicemailMessage;

use Assert\Assertion;

/**
* MetadataFile
* @codeCoverageIgnore
*/
final class MetadataFile
{
    /**
     * @var ?int
     * column: metadataFileFileSize
     * comment: FSO:keepExtension
     */
    private $fileSize = null;

    /**
     * @var ?string
     * column: metadataFileMimeType
     */
    private $mimeType = null;

    /**
     * @var ?string
     * column: metadataFileBaseName
     */
    private $baseName = null;

    /**
     * Constructor
     */
    public function __construct(
        ?int $fileSize,
        ?string $mimeType,
        ?string $baseName
    ) {
        $this->setFileSize($fileSize);
        $this->setMimeType($mimeType);
        $this->setBaseName($baseName);
    }

    public function equals(self $metadataFile): bool
    {
        if ($this->getFileSize() !== $metadataFile->getFileSize()) {
            return false;
        }
        if ($this->getMimeType() !== $metadataFile->getMimeType()) {
            return false;
        }
        return $this->getBaseName() === $metadataFile->getBaseName();
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
}
