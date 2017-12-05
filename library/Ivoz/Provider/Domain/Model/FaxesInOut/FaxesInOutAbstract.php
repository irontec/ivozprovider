<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * FaxesInOutAbstract
 * @codeCoverageIgnore
 */
abstract class FaxesInOutAbstract
{
    /**
     * @var \DateTime
     */
    protected $calldate;

    /**
     * @var string
     */
    protected $src;

    /**
     * @var string
     */
    protected $dst;

    /**
     * @comment enum:In|Out
     * @var string
     */
    protected $type = 'Out';

    /**
     * @var string
     */
    protected $pages;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var File
     */
    protected $file;

    /**
     * @var \Ivoz\Provider\Domain\Model\Fax\FaxInterface
     */
    protected $fax;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $dstCountry;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($calldate, File $file)
    {
        $this->setCalldate($calldate);
        $this->setFile($file);

        $this->sanitizeValues();
        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }

            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @return FaxesInOutDTO
     */
    public static function createDTO()
    {
        return new FaxesInOutDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto FaxesInOutDTO
         */
        Assertion::isInstanceOf($dto, FaxesInOutDTO::class);

        $file = new File(
            $dto->getFileFileSize(),
            $dto->getFileMimeType(),
            $dto->getFileBaseName()
        );

        $self = new static(
            $dto->getCalldate(),
            $file
        );

        return $self
            ->setSrc($dto->getSrc())
            ->setDst($dto->getDst())
            ->setType($dto->getType())
            ->setPages($dto->getPages())
            ->setStatus($dto->getStatus())
            ->setFax($dto->getFax())
            ->setDstCountry($dto->getDstCountry())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto FaxesInOutDTO
         */
        Assertion::isInstanceOf($dto, FaxesInOutDTO::class);

        $file = new File(
            $dto->getFileFileSize(),
            $dto->getFileMimeType(),
            $dto->getFileBaseName()
        );

        $this
            ->setCalldate($dto->getCalldate())
            ->setSrc($dto->getSrc())
            ->setDst($dto->getDst())
            ->setType($dto->getType())
            ->setPages($dto->getPages())
            ->setStatus($dto->getStatus())
            ->setFile($file)
            ->setFax($dto->getFax())
            ->setDstCountry($dto->getDstCountry());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @return FaxesInOutDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setCalldate($this->getCalldate())
            ->setSrc($this->getSrc())
            ->setDst($this->getDst())
            ->setType($this->getType())
            ->setPages($this->getPages())
            ->setStatus($this->getStatus())
            ->setFileFileSize($this->getFile()->getFileSize())
            ->setFileMimeType($this->getFile()->getMimeType())
            ->setFileBaseName($this->getFile()->getBaseName())
            ->setFaxId($this->getFax() ? $this->getFax()->getId() : null)
            ->setDstCountryId($this->getDstCountry() ? $this->getDstCountry()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'calldate' => self::getCalldate(),
            'src' => self::getSrc(),
            'dst' => self::getDst(),
            'type' => self::getType(),
            'pages' => self::getPages(),
            'status' => self::getStatus(),
            'fileFileSize' => self::getFile()->getFileSize(),
            'fileMimeType' => self::getFile()->getMimeType(),
            'fileBaseName' => self::getFile()->getBaseName(),
            'faxId' => self::getFax() ? self::getFax()->getId() : null,
            'dstCountryId' => self::getDstCountry() ? self::getDstCountry()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set calldate
     *
     * @param \DateTime $calldate
     *
     * @return self
     */
    public function setCalldate($calldate)
    {
        Assertion::notNull($calldate, 'calldate value "%s" is null, but non null value was expected.');
        $calldate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $calldate,
            null
        );

        $this->calldate = $calldate;

        return $this;
    }

    /**
     * Get calldate
     *
     * @return \DateTime
     */
    public function getCalldate()
    {
        return $this->calldate;
    }

    /**
     * Set src
     *
     * @param string $src
     *
     * @return self
     */
    public function setSrc($src = null)
    {
        if (!is_null($src)) {
            Assertion::maxLength($src, 128, 'src value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->src = $src;

        return $this;
    }

    /**
     * Get src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set dst
     *
     * @param string $dst
     *
     * @return self
     */
    public function setDst($dst = null)
    {
        if (!is_null($dst)) {
            Assertion::maxLength($dst, 128, 'dst value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->dst = $dst;

        return $this;
    }

    /**
     * Get dst
     *
     * @return string
     */
    public function getDst()
    {
        return $this->dst;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type = null)
    {
        if (!is_null($type)) {
            Assertion::maxLength($type, 20, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($type, array (
          0 => 'In',
          1 => 'Out',
        ), 'typevalue "%s" is not an element of the valid values: %s');
        }

        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set pages
     *
     * @param string $pages
     *
     * @return self
     */
    public function setPages($pages = null)
    {
        if (!is_null($pages)) {
            Assertion::maxLength($pages, 64, 'pages value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->pages = $pages;

        return $this;
    }

    /**
     * Get pages
     *
     * @return string
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return self
     */
    public function setStatus($status = null)
    {
        if (!is_null($status)) {
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set fax
     *
     * @param \Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax
     *
     * @return self
     */
    public function setFax(\Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return \Ivoz\Provider\Domain\Model\Fax\FaxInterface
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set dstCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $dstCountry
     *
     * @return self
     */
    public function setDstCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $dstCountry = null)
    {
        $this->dstCountry = $dstCountry;

        return $this;
    }

    /**
     * Get dstCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getDstCountry()
    {
        return $this->dstCountry;
    }

    /**
     * Set file
     *
     * @param \Ivoz\Provider\Domain\Model\FaxesInOut\File $file
     *
     * @return self
     */
    public function setFile(File $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return \Ivoz\Provider\Domain\Model\FaxesInOut\File
     */
    public function getFile()
    {
        return $this->file;
    }

    // @codeCoverageIgnoreEnd
}

