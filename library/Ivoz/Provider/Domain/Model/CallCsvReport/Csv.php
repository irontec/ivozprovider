<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\CallCsvReport;

use Assert\Assertion;

/**
* Csv
* @codeCoverageIgnore
*/
class Csv
{
    /**
     * column: csvFileSize
     * comment: FSO
     * @var int | null
     */
    protected $fileSize;

    /**
     * column: csvMimeType
     * @var string | null
     */
    protected $mimeType;

    /**
     * column: csvBaseName
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
    public function equals(self $csv)
    {
        return
            $this->getFileSize() === $csv->getFileSize() &&
            $this->getMimeType() === $csv->getMimeType() &&
            $this->getBaseName() === $csv->getBaseName();
    }

    /**
     * Set fileSize
     *
     * @param int $fileSize | null
     *
     * @return static
     */
    protected function setFileSize(?int $fileSize = null): Csv
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
    protected function setMimeType(?string $mimeType = null): Csv
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
    protected function setBaseName(?string $baseName = null): Csv
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
