<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Assert\Assertion;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * File
 * @codeCoverageIgnore
 */
class File
{
    /**
     * column: fileFileSize
     * comment: FSO
     * @var integer | null
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
    protected $importerArguments;


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

    // @codeCoverageIgnoreStart

    /**
     * Set fileSize
     *
     * @param integer $fileSize
     *
     * @return self
     */
    protected function setFileSize($fileSize = null)
    {
        if (!is_null($fileSize)) {
            if (!is_null($fileSize)) {
                Assertion::integerish($fileSize, 'fileSize value "%s" is not an integer or a number castable to integer.');
                Assertion::greaterOrEqualThan($fileSize, 0, 'fileSize provided "%s" is not greater or equal than "%s".');
            }
        }

        $this->fileSize = $fileSize;

        return $this;
    }

    /**
     * Get fileSize
     *
     * @return integer | null
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Set mimeType
     *
     * @param string $mimeType
     *
     * @return self
     */
    protected function setMimeType($mimeType = null)
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
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set baseName
     *
     * @param string $baseName
     *
     * @return self
     */
    protected function setBaseName($baseName = null)
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
    public function getBaseName()
    {
        return $this->baseName;
    }

    /**
     * Set importerArguments
     *
     * @param array $importerArguments
     *
     * @return self
     */
    protected function setImporterArguments($importerArguments = null)
    {
        if (!is_null($importerArguments)) {
        }

        $this->importerArguments = $importerArguments;

        return $this;
    }

    /**
     * Get importerArguments
     *
     * @return array | null
     */
    public function getImporterArguments()
    {
        return $this->importerArguments;
    }

    // @codeCoverageIgnoreEnd
}
