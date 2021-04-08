<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\FaxesInOut\File;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Fax\Fax;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* FaxesInOutAbstract
* @codeCoverageIgnore
*/
abstract class FaxesInOutAbstract
{
    use ChangelogTrait;

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
     * @var FaxInterface
     */
    protected $fax;

    /**
     * @var CountryInterface | null
     */
    protected $dstCountry;

    /**
     * Constructor
     */
    protected function __construct(
        $calldate,
        File $file
    ) {
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
     * @param mixed $id
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
        ForeignKeyTransformerInterface $fkTransformer
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
            ->setDstCountry($fkTransformer->transform($dto->getDstCountry()));

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
        ForeignKeyTransformerInterface $fkTransformer
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
            ->setFax(Fax::entityToDto(self::getFax(), $depth))
            ->setDstCountry(Country::entityToDto(self::getDstCountry(), $depth));
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

    protected function setCalldate($calldate): static
    {

        $calldate = DateTimeHelper::createOrFix(
            $calldate,
            null
        );

        if ($this->calldate == $calldate) {
            return $this;
        }

        $this->calldate = $calldate;

        return $this;
    }

    public function getCalldate(): \DateTime
    {
        return clone $this->calldate;
    }

    protected function setSrc(?string $src = null): static
    {
        if (!is_null($src)) {
            Assertion::maxLength($src, 128, 'src value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->src = $src;

        return $this;
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    protected function setDst(?string $dst = null): static
    {
        if (!is_null($dst)) {
            Assertion::maxLength($dst, 128, 'dst value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->dst = $dst;

        return $this;
    }

    public function getDst(): ?string
    {
        return $this->dst;
    }

    protected function setType(?string $type = null): static
    {
        if (!is_null($type)) {
            Assertion::maxLength($type, 20, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $type,
                [
                    FaxesInOutInterface::TYPE_IN,
                    FaxesInOutInterface::TYPE_OUT,
                ],
                'typevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    protected function setPages(?string $pages = null): static
    {
        if (!is_null($pages)) {
            Assertion::maxLength($pages, 64, 'pages value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->pages = $pages;

        return $this;
    }

    public function getPages(): ?string
    {
        return $this->pages;
    }

    protected function setStatus(?string $status = null): static
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    protected function setFile(File $file): static
    {
        $isEqual = $this->file && $this->file->equals($file);
        if ($isEqual) {
            return $this;
        }

        $this->file = $file;
        return $this;
    }

    protected function setFax(FaxInterface $fax): static
    {
        $this->fax = $fax;

        return $this;
    }

    public function getFax(): FaxInterface
    {
        return $this->fax;
    }

    protected function setDstCountry(?CountryInterface $dstCountry = null): static
    {
        $this->dstCountry = $dstCountry;

        return $this;
    }

    public function getDstCountry(): ?CountryInterface
    {
        return $this->dstCountry;
    }
}
