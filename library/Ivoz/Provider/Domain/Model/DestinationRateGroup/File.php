<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Assert\Assertion;

/**
* File
* @codeCoverageIgnore
*/
class File
{
    /**
     * column: fileFileSize
     * comment: FSO
     * @var int | null
     */
    protected $fileSize;

    /**
     * column: fileMimeType
     * @var string | null
     */
    protected $mimeType;

    /**
     * column: fileBaseName
     * @var string | null
     */
    protected $baseName;

    /**
     * column: fileImporterArguments
     * @var array | null
     */
    protected $importerArguments = [];

    /**
     * Constructor
     */
    public function __construct(
        $fileSize,
        $mimeType,
        $baseName,
        $importerArguments
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
        return
            $this->getFileSize() === $file->getFileSize() &&
            $this->getMimeType() === $file->getMimeType() &&
            $this->getBaseName() === $file->getBaseName() &&
            $this->getImporterArguments() === $file->getImporterArguments();
    }

    /**
     * Set fileSize
     *
     * @param int $fileSize | null
     *
     * @return static
     */
    protected function setFileSize(?int $fileSize = null): File
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
    protected function setMimeType(?string $mimeType = null): File
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
    protected function setBaseName(?string $baseName = null): File
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

    /**
     * Set importerArguments
     *
     * @param array $importerArguments | null
     *
     * @return static
     */
    protected function setImporterArguments(?array $importerArguments = null): File
    {
        $this->importerArguments = $importerArguments;

        return $this;
    }

    /**
     * Get importerArguments
     *
     * @return array | null
     */
    public function getImporterArguments(): ?array
    {
        return $this->importerArguments;
    }

}
