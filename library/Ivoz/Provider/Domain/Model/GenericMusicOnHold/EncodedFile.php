<?php

namespace Ivoz\Provider\Domain\Model\GenericMusicOnHold;

use Assert\Assertion;

/**
 * EncodedFile
 * @codeCoverageIgnore
 */
class EncodedFile
{
    /**
     * @column encodedFileFileSize
     * @comment FSO:keepExtension|storeInBaseFolder
     * @var integer
     */
    protected $fileSize;

    /**
     * @column encodedFileMimeType
     * @var string
     */
    protected $mimeType;

    /**
     * @column encodedFileBaseName
     * @var string
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
     * @return integer
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
     * @return string
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
     * @return string
     */
    public function getBaseName()
    {
        return $this->baseName;
    }



    // @codeCoverageIgnoreEnd
}

