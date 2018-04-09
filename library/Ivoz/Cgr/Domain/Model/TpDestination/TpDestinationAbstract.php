<?php

namespace Ivoz\Cgr\Domain\Model\TpDestination;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TpDestinationAbstract
 * @codeCoverageIgnore
 */
abstract class TpDestinationAbstract
{
    /**
     * @var string
     */
    protected $tpid = 'ivozprovider';

    /**
     * @var string
     */
    protected $tag;

    /**
     * @var string
     */
    protected $prefix;

    /**
     * @var string
     */
    protected $name;

    /**
     * column: created_at
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface
     */
    protected $tpDestinationRate;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($tpid, $prefix, $createdAt)
    {
        $this->setTpid($tpid);
        $this->setPrefix($prefix);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
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
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpDestinationDto
         */
        Assertion::isInstanceOf($dto, TpDestinationDto::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getPrefix(),
            $dto->getCreatedAt());

        $self
            ->setTag($dto->getTag())
            ->setName($dto->getName())
            ->setTpDestinationRate($dto->getTpDestinationRate())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpDestinationDto
         */
        Assertion::isInstanceOf($dto, TpDestinationDto::class);

        $this
            ->setTpid($dto->getTpid())
            ->setTag($dto->getTag())
            ->setPrefix($dto->getPrefix())
            ->setName($dto->getName())
            ->setCreatedAt($dto->getCreatedAt())
            ->setTpDestinationRate($dto->getTpDestinationRate());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return TpDestinationDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTpid(self::getTpid())
            ->setTag(self::getTag())
            ->setPrefix(self::getPrefix())
            ->setName(self::getName())
            ->setCreatedAt(self::getCreatedAt())
            ->setTpDestinationRate(\Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRate::entityToDto(self::getTpDestinationRate(), $depth));
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
            'name' => self::getName(),
            'created_at' => self::getCreatedAt(),
            'tpDestinationRateId' => self::getTpDestinationRate() ? self::getTpDestinationRate()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set tpid
     *
     * @param string $tpid
     *
     * @return self
     */
    public function setTpid($tpid)
    {
        Assertion::notNull($tpid, 'tpid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag = null)
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
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return self
     */
    public function setPrefix($prefix)
    {
        Assertion::notNull($prefix, 'prefix value "%s" is null, but non null value was expected.');
        Assertion::maxLength($prefix, 24, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name = null)
    {
        if (!is_null($name)) {
            Assertion::maxLength($name, 64, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        Assertion::notNull($createdAt, 'createdAt value "%s" is null, but non null value was expected.');
        $createdAt = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set tpDestinationRate
     *
     * @param \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface $tpDestinationRate
     *
     * @return self
     */
    public function setTpDestinationRate(\Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface $tpDestinationRate)
    {
        $this->tpDestinationRate = $tpDestinationRate;

        return $this;
    }

    /**
     * Get tpDestinationRate
     *
     * @return \Ivoz\Cgr\Domain\Model\TpDestinationRate\TpDestinationRateInterface
     */
    public function getTpDestinationRate()
    {
        return $this->tpDestinationRate;
    }



    // @codeCoverageIgnoreEnd
}

