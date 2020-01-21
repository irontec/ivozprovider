<?php

namespace Ivoz\Ast\Domain\Model\Queue;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * QueueAbstract
 * @codeCoverageIgnore
 */
abstract class QueueAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * column: periodic_announce
     * @var string | null
     */
    protected $periodicAnnounce;

    /**
     * column: periodic_announce_frequency
     * @var integer | null
     */
    protected $periodicAnnounceFrequency;

    /**
     * @var integer | null
     */
    protected $timeout;

    /**
     * @var string
     */
    protected $autopause = 'no';

    /**
     * @var string
     */
    protected $ringinuse = 'no';

    /**
     * @var integer | null
     */
    protected $wrapuptime;

    /**
     * @var integer | null
     */
    protected $maxlen;

    /**
     * @var string | null
     */
    protected $strategy;

    /**
     * @var integer | null
     */
    protected $weight;

    /**
     * @var \Ivoz\Provider\Domain\Model\Queue\QueueInterface
     */
    protected $queue;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($name, $autopause, $ringinuse)
    {
        $this->setName($name);
        $this->setAutopause($autopause);
        $this->setRinginuse($ringinuse);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Queue",
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
     * @return QueueDto
     */
    public static function createDto($id = null)
    {
        return new QueueDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param QueueInterface|null $entity
     * @param int $depth
     * @return QueueDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, QueueInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var QueueDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param QueueDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, QueueDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getAutopause(),
            $dto->getRinginuse()
        );

        $self
            ->setPeriodicAnnounce($dto->getPeriodicAnnounce())
            ->setPeriodicAnnounceFrequency($dto->getPeriodicAnnounceFrequency())
            ->setTimeout($dto->getTimeout())
            ->setWrapuptime($dto->getWrapuptime())
            ->setMaxlen($dto->getMaxlen())
            ->setStrategy($dto->getStrategy())
            ->setWeight($dto->getWeight())
            ->setQueue($fkTransformer->transform($dto->getQueue()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param QueueDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, QueueDto::class);

        $this
            ->setName($dto->getName())
            ->setPeriodicAnnounce($dto->getPeriodicAnnounce())
            ->setPeriodicAnnounceFrequency($dto->getPeriodicAnnounceFrequency())
            ->setTimeout($dto->getTimeout())
            ->setAutopause($dto->getAutopause())
            ->setRinginuse($dto->getRinginuse())
            ->setWrapuptime($dto->getWrapuptime())
            ->setMaxlen($dto->getMaxlen())
            ->setStrategy($dto->getStrategy())
            ->setWeight($dto->getWeight())
            ->setQueue($fkTransformer->transform($dto->getQueue()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return QueueDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setPeriodicAnnounce(self::getPeriodicAnnounce())
            ->setPeriodicAnnounceFrequency(self::getPeriodicAnnounceFrequency())
            ->setTimeout(self::getTimeout())
            ->setAutopause(self::getAutopause())
            ->setRinginuse(self::getRinginuse())
            ->setWrapuptime(self::getWrapuptime())
            ->setMaxlen(self::getMaxlen())
            ->setStrategy(self::getStrategy())
            ->setWeight(self::getWeight())
            ->setQueue(\Ivoz\Provider\Domain\Model\Queue\Queue::entityToDto(self::getQueue(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'periodic_announce' => self::getPeriodicAnnounce(),
            'periodic_announce_frequency' => self::getPeriodicAnnounceFrequency(),
            'timeout' => self::getTimeout(),
            'autopause' => self::getAutopause(),
            'ringinuse' => self::getRinginuse(),
            'wrapuptime' => self::getWrapuptime(),
            'maxlen' => self::getMaxlen(),
            'strategy' => self::getStrategy(),
            'weight' => self::getWeight(),
            'queueId' => self::getQueue() ? self::getQueue()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 128, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set periodicAnnounce
     *
     * @param string $periodicAnnounce | null
     *
     * @return static
     */
    protected function setPeriodicAnnounce($periodicAnnounce = null)
    {
        if (!is_null($periodicAnnounce)) {
            Assertion::maxLength($periodicAnnounce, 128, 'periodicAnnounce value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->periodicAnnounce = $periodicAnnounce;

        return $this;
    }

    /**
     * Get periodicAnnounce
     *
     * @return string | null
     */
    public function getPeriodicAnnounce()
    {
        return $this->periodicAnnounce;
    }

    /**
     * Set periodicAnnounceFrequency
     *
     * @param integer $periodicAnnounceFrequency | null
     *
     * @return static
     */
    protected function setPeriodicAnnounceFrequency($periodicAnnounceFrequency = null)
    {
        if (!is_null($periodicAnnounceFrequency)) {
            Assertion::integerish($periodicAnnounceFrequency, 'periodicAnnounceFrequency value "%s" is not an integer or a number castable to integer.');
            $periodicAnnounceFrequency = (int) $periodicAnnounceFrequency;
        }

        $this->periodicAnnounceFrequency = $periodicAnnounceFrequency;

        return $this;
    }

    /**
     * Get periodicAnnounceFrequency
     *
     * @return integer | null
     */
    public function getPeriodicAnnounceFrequency()
    {
        return $this->periodicAnnounceFrequency;
    }

    /**
     * Set timeout
     *
     * @param integer $timeout | null
     *
     * @return static
     */
    protected function setTimeout($timeout = null)
    {
        if (!is_null($timeout)) {
            Assertion::integerish($timeout, 'timeout value "%s" is not an integer or a number castable to integer.');
            $timeout = (int) $timeout;
        }

        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get timeout
     *
     * @return integer | null
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Set autopause
     *
     * @param string $autopause
     *
     * @return static
     */
    protected function setAutopause($autopause)
    {
        Assertion::notNull($autopause, 'autopause value "%s" is null, but non null value was expected.');

        $this->autopause = $autopause;

        return $this;
    }

    /**
     * Get autopause
     *
     * @return string
     */
    public function getAutopause()
    {
        return $this->autopause;
    }

    /**
     * Set ringinuse
     *
     * @param string $ringinuse
     *
     * @return static
     */
    protected function setRinginuse($ringinuse)
    {
        Assertion::notNull($ringinuse, 'ringinuse value "%s" is null, but non null value was expected.');

        $this->ringinuse = $ringinuse;

        return $this;
    }

    /**
     * Get ringinuse
     *
     * @return string
     */
    public function getRinginuse()
    {
        return $this->ringinuse;
    }

    /**
     * Set wrapuptime
     *
     * @param integer $wrapuptime | null
     *
     * @return static
     */
    protected function setWrapuptime($wrapuptime = null)
    {
        if (!is_null($wrapuptime)) {
            Assertion::integerish($wrapuptime, 'wrapuptime value "%s" is not an integer or a number castable to integer.');
            $wrapuptime = (int) $wrapuptime;
        }

        $this->wrapuptime = $wrapuptime;

        return $this;
    }

    /**
     * Get wrapuptime
     *
     * @return integer | null
     */
    public function getWrapuptime()
    {
        return $this->wrapuptime;
    }

    /**
     * Set maxlen
     *
     * @param integer $maxlen | null
     *
     * @return static
     */
    protected function setMaxlen($maxlen = null)
    {
        if (!is_null($maxlen)) {
            Assertion::integerish($maxlen, 'maxlen value "%s" is not an integer or a number castable to integer.');
            $maxlen = (int) $maxlen;
        }

        $this->maxlen = $maxlen;

        return $this;
    }

    /**
     * Get maxlen
     *
     * @return integer | null
     */
    public function getMaxlen()
    {
        return $this->maxlen;
    }

    /**
     * Set strategy
     *
     * @param string $strategy | null
     *
     * @return static
     */
    protected function setStrategy($strategy = null)
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * Get strategy
     *
     * @return string | null
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * Set weight
     *
     * @param integer $weight | null
     *
     * @return static
     */
    protected function setWeight($weight = null)
    {
        if (!is_null($weight)) {
            Assertion::integerish($weight, 'weight value "%s" is not an integer or a number castable to integer.');
            $weight = (int) $weight;
        }

        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer | null
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set queue
     *
     * @param \Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue
     *
     * @return static
     */
    public function setQueue(\Ivoz\Provider\Domain\Model\Queue\QueueInterface $queue)
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * Get queue
     *
     * @return \Ivoz\Provider\Domain\Model\Queue\QueueInterface
     */
    public function getQueue()
    {
        return $this->queue;
    }

    // @codeCoverageIgnoreEnd
}
