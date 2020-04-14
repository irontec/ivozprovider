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
     * @var File | null
     */
    protected $file;

    /**
     * @var \Ivoz\Provider\Domain\Model\Fax\FaxInterface
     */
    protected $fax;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
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
     * @param FaxesInOutInterface|null $entity
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

        /** @var FaxesInOutDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FaxesInOutDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setFax($fkTransformer->transform($dto->getFax()))
            ->setDstCountry($fkTransformer->transform($dto->getDstCountry()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FaxesInOutDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setFax($fkTransformer->transform($dto->getFax()))
            ->setDstCountry($fkTransformer->transform($dto->getDstCountry()));



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
            'faxId' => self::getFax()->getId(),
            'dstCountryId' => self::getDstCountry() ? self::getDstCountry()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set calldate
     *
     * @param \DateTime $calldate
     *
     * @return static
     */
    protected function setCalldate($calldate)
    {
        Assertion::notNull($calldate, 'calldate value "%s" is null, but non null value was expected.');
        $calldate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $calldate,
            null
        );

        if ($this->calldate == $calldate) {
            return $this;
        }

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
        return clone $this->calldate;
    }

    /**
     * Set src
     *
     * @param string $src | null
     *
     * @return static
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
     * @param string $dst | null
     *
     * @return static
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
     * @param string $type | null
     *
     * @return static
     */
    protected function setType($type = null)
    {
        if (!is_null($type)) {
            Assertion::maxLength($type, 20, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($type, [
                FaxesInOutInterface::TYPE_IN,
                FaxesInOutInterface::TYPE_OUT
            ], 'typevalue "%s" is not an element of the valid values: %s');
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
     * @param string $pages | null
     *
     * @return static
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
     * @param string $status | null
     *
     * @return static
     */
    protected function setStatus($status = null)
    {
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
     * @return static
     */
    protected function setFax(\Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax)
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
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $dstCountry | null
     *
     * @return static
     */
    protected function setDstCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $dstCountry = null)
    {
        $this->dstCountry = $dstCountry;

        return $this;
    }

    /**
     * Get dstCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
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
     * @return static
     */
    protected function setFile(File $file)
    {
        $isEqual = $this->file && $this->file->equals($file);
        if ($isEqual) {
            return $this;
        }

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
