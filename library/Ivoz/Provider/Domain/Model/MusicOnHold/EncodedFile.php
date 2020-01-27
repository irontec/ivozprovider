<?php

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Assert\Assertion;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * EncodedFile
 * @codeCoverageIgnore
 */
class EncodedFile
{
    /**
     * column: encodedFileFileSize
     * comment: FSO:keepExtension|storeInBaseFolder
     * @var integer | null
     */
    protected $fileSize;

    /**
     * column: encodedFileMimeType
     * @var string | null
     */
    protected $mimeType;

    /**
     * column: encodedFileBaseName
     * @var string | null
     */
    protected $baseName;


    /**
     * Constructor
     */
    public function __construct($fileSize, $mimeType, $baseName)
    {
        $this->setFileSize($fileSize);
        $this->setMimeType($mimeType);
        $this->setBaseName($baseName);
    }

    /**
     * Equals
     */
    public function equals(self $encodedFile)
    {
        return
            $this->getFileSize() === $encodedFile->getFileSize() &&
            $this->getMimeType() === $encodedFile->getMimeType() &&
            $this->getBaseName() === $encodedFile->getBaseName();
    }


    // @codeCoverageIgnoreStart

    /**
     * Set fileSize
     *
     * @param integer $fileSize | null
     *
     * @return static
     */
    protected function setFileSize($fileSize = null)
    {
        if (!is_null($fileSize)) {
            Assertion::integerish($fileSize, 'fileSize value "%s" is not an integer or a number castable to integer.');
            Assertion::greaterOrEqualThan($fileSize, 0, 'fileSize provided "%s" is not greater or equal than "%s".');
            $fileSize = (int) $fileSize;
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
     * @param string $mimeType | null
     *
     * @return static
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
     * @param string $baseName | null
     *
     * @return static
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

    // @codeCoverageIgnoreEnd
}
