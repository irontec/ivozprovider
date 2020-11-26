<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Brand;

use Assert\Assertion;

/**
* Logo
* @codeCoverageIgnore
*/
class Logo
{
    /**
     * column: logoFileSize
     * comment: FSO
     * @var int | null
     */
    protected $fileSize;

    /**
     * column: logoMimeType
     * @var string | null
     */
    protected $mimeType;

    /**
     * column: logoBaseName
     * @var string | null
     */
    protected $baseName;

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

    /**
     * Set fileSize
     *
     * @param int $fileSize | null
     *
     * @return static
     */
    protected function setFileSize(?int $fileSize = null): Logo
    {
        if (!is_null($fileSize)) {
            Assertion::greaterOrEqualThan($fileSize, 0, 'fileSize provided "%s" is not greater or equal than "%s".');
        }

        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Get fileSize
     *
     * @return int | null
     */
    public function getFileSize(): ?int
    {
        return $this->fileSize;
    }

    /**
     * Set mimeType
     *
     * @param string $mimeType | null
     *
     * @return static
     */
    protected function setMimeType(?string $mimeType = null): Logo
    {
        if (!is_null($mimeType)) {
            Assertion::maxLength($mimeType, 80, 'mimeType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string | null
     */
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * Set baseName
     *
     * @param string $baseName | null
     *
     * @return static
     */
    protected function setBaseName(?string $baseName = null): Logo
    {
        if (!is_null($baseName)) {
            Assertion::maxLength($baseName, 255, 'baseName value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->baseName = $baseName;

        return $this;
    }

    /**
     * Get baseName
     *
     * @return string | null
     */
    public function getBaseName(): ?string
    {
        return $this->baseName;
    }

}
