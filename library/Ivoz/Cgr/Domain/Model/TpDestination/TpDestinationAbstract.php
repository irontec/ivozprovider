<?php
declare(strict_types = 1);

namespace Ivoz\Cgr\Domain\Model\TpDestination;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Destination\Destination;

/**
* TpDestinationAbstract
* @codeCoverageIgnore
*/
abstract class TpDestinationAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $tpid = 'ivozprovider';

    /**
     * @var string | null
     */
    protected $tag;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * column: created_at
     * @var \DateTimeInterface
     */
    protected $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var Destination
     * inversedBy tpDestination
     */
    protected $destination;

    /**
     * Constructor
     */
    protected function __construct(
        $tpid,
        $prefix,
        $createdAt
    ) {
        $this->setTpid($tpid);
        $this->setPrefix($prefix);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TpDestination",
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
     * @return TpDestinationDto
     */
    public static function createDto($id = null)
    {
        return new TpDestinationDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param TpDestinationInterface|null $entity
     * @param int $depth
     * @return TpDestinationDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpDestinationInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var TpDestinationDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpDestinationDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TpDestinationDto::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getPrefix(),
            $dto->getCreatedAt()
        );

        $self
            ->setTag($dto->getTag())
            ->setDestination($fkTransformer->transform($dto->getDestination()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TpDestinationDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TpDestinationDto::class);

        $this
            ->setTpid($dto->getTpid())
            ->setTag($dto->getTag())
            ->setPrefix($dto->getPrefix())
            ->setCreatedAt($dto->getCreatedAt())
            ->setDestination($fkTransformer->transform($dto->getDestination()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TpDestinationDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTpid(self::getTpid())
            ->setTag(self::getTag())
            ->setPrefix(self::getPrefix())
            ->setCreatedAt(self::getCreatedAt())
            ->setDestination(Destination::entityToDto(self::getDestination(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'tpid' => self::getTpid(),
            'tag' => self::getTag(),
            'prefix' => self::getPrefix(),
            'created_at' => self::getCreatedAt(),
            'destinationId' => self::getDestination()->getId()
        ];
    }

    /**
     * Set tpid
     *
     * @param string $tpid
     *
     * @return static
     */
    protected function setTpid(string $tpid): TpDestinationInterface
    {
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid(): string
    {
        return $this->tpid;
    }

    /**
     * Set tag
     *
     * @param string $tag | null
     *
     * @return static
     */
    protected function setTag(?string $tag = null): TpDestinationInterface
    {
        if (!is_null($tag)) {
            Assertion::maxLength($tag, 64, 'tag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string | null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return static
     */
    protected function setPrefix(string $prefix): TpDestinationInterface
    {
        Assertion::maxLength($prefix, 24, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * Set createdAt
     *
     * @param \DateTimeInterface $createdAt
     *
     * @return static
     */
    protected function setCreatedAt($createdAt): TpDestinationInterface
    {

        $createdAt = DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        if ($this->createdAt == $createdAt) {
            return $this;
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return clone $this->createdAt;
    }

    /**
     * Set destination
     *
     * @param Destination
     *
     * @return static
     */
    public function setDestination(Destination $destination): TpDestinationInterface
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return Destination
     */
    public function getDestination(): Destination
    {
        return $this->destination;
    }

}
