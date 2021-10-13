<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Brand;

use Assert\Assertion;

/**
* Logo
* @codeCoverageIgnore
*/
final class Logo
{
    /**
     * column: logoFileSize
     * comment: FSO
     * @var int | null
     */
    private $fileSize;

    /**
     * column: logoMimeType
     * @var string | null
     */
    private $mimeType;

    /**
     * column: logoBaseName
     * @var string | null
     */
    private $baseName;

    /**
     * Constructor
     */
    public function __construct(
        $fileSize,
        $mimeType,
        $baseName
    ) {
        $this->setFileSize($fileSize);
        $this->setMimeType($mimeType);
        $this->setBaseName($baseName);
    }

    /**
     * Equals
     */
    public function equals(self $logo)
    {
        return
            $this->getFileSize() === $logo->getFileSize() &&
            $this->getMimeType() === $logo->getMimeType() &&
            $this->getBaseName() === $logo->getBaseName();
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
