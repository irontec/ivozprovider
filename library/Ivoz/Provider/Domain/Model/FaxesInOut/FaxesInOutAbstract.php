<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

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
     * @var string | null
     */
    protected $src;

    /**
     * @var string | null
     */
    protected $dst;

    /**
     * comment: enum:In|Out
     * @var string | null
     */
    protected $type = 'Out';

    /**
     * @var string | null
     */
    protected $pages;

    /**
     * @var string | null
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


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($calldate, File $file)
    {
        $this->setCalldate($calldate);
        $this->setFile($file);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "FaxesInOut",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return FaxesInOutDto
     */
    public static function createDto($id = null)
    {
        return new FaxesInOutDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return FaxesInOutDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, FaxesInOutInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto FaxesInOutDto
         */
        Assertion::isInstanceOf($dto, FaxesInOutDto::class);

        $file = new File(
            $dto->getFileFileSize(),
            $dto->getFileMimeType(),
            $dto->getFileBaseName()
        );

        $self = new static(
            $dto->getCalldate(),
            $file
        );

        $self
            ->setSrc($dto->getSrc())
            ->setDst($dto->getDst())
            ->setType($dto->getType())
            ->setPages($dto->getPages())
            ->setStatus($dto->getStatus())
            ->setFax($dto->getFax())
            ->setDstCountry($dto->getDstCountry())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto FaxesInOutDto
         */
        Assertion::isInstanceOf($dto, FaxesInOutDto::class);

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
     * @internal use EntityTools instead
     * @param int $depth
     * @return FaxesInOutDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCalldate(self::getCalldate())
            ->setSrc(self::getSrc())
            ->setDst(self::getDst())
            ->setType(self::getType())
            ->setPages(self::getPages())
            ->setStatus(self::getStatus())
            ->setFileFileSize(self::getFile()->getFileSize())
            ->setFileMimeType(self::getFile()->getMimeType())
            ->setFileBaseName(self::getFile()->getBaseName())
            ->setFax(\Ivoz\Provider\Domain\Model\Fax\Fax::entityToDto(self::getFax(), $depth))
            ->setDstCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getDstCountry(), $depth));
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
    protected function setCalldate($calldate)
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
    protected function setSrc($src = null)
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
     * @return string | null
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
    protected function setDst($dst = null)
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
     * @return string | null
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
    protected function setType($type = null)
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
     * @return string | null
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
    protected function setPages($pages = null)
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
     * @return string | null
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
    protected function setStatus($status = null)
    {
        if (!is_null($status)) {
        }

        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string | null
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
