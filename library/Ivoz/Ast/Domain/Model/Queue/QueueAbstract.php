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
     * @var string
     */
    protected $periodicAnnounce;

    /**
     * column: periodic_announce_frequency
     * @var integer
     */
    protected $periodicAnnounceFrequency;

    /**
     * @var integer
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
     * @var integer
     */
    protected $wrapuptime;

    /**
     * @var integer
     */
    protected $maxlen;

    /**
     * @var string
     */
    protected $strategy;

    /**
     * @var integer
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
     * @param EntityInterface|null $entity
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
         * @var $dto QueueDto
         */
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
            ->setQueue($dto->getQueue())
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
         * @var $dto QueueDto
         */
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
            ->setQueue($dto->getQueue());



        $this->sanitizeValues();
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
     * @deprecated
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
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
     * @deprecated
     * Set periodicAnnounce
     *
     * @param string $periodicAnnounce
     *
     * @return self
     */
    public function setPeriodicAnnounce($periodicAnnounce = null)
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
     * @return string
     */
    public function getPeriodicAnnounce()
    {
        return $this->periodicAnnounce;
    }

    /**
     * @deprecated
     * Set periodicAnnounceFrequency
     *
     * @param integer $periodicAnnounceFrequency
     *
     * @return self
     */
    public function setPeriodicAnnounceFrequency($periodicAnnounceFrequency = null)
    {
        if (!is_null($periodicAnnounceFrequency)) {
            if (!is_null($periodicAnnounceFrequency)) {
                Assertion::integerish($periodicAnnounceFrequency, 'periodicAnnounceFrequency value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->periodicAnnounceFrequency = $periodicAnnounceFrequency;

        return $this;
    }

    /**
     * Get periodicAnnounceFrequency
     *
     * @return integer
     */
    public function getPeriodicAnnounceFrequency()
    {
        return $this->periodicAnnounceFrequency;
    }

    /**
     * @deprecated
     * Set timeout
     *
     * @param integer $timeout
     *
     * @return self
     */
    public function setTimeout($timeout = null)
    {
        if (!is_null($timeout)) {
            if (!is_null($timeout)) {
                Assertion::integerish($timeout, 'timeout value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get timeout
     *
     * @return integer
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @deprecated
     * Set autopause
     *
     * @param string $autopause
     *
     * @return self
     */
    public function setAutopause($autopause)
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
     * @deprecated
     * Set ringinuse
     *
     * @param string $ringinuse
     *
     * @return self
     */
    public function setRinginuse($ringinuse)
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
     * @deprecated
     * Set wrapuptime
     *
     * @param integer $wrapuptime
     *
     * @return self
     */
    public function setWrapuptime($wrapuptime = null)
    {
        if (!is_null($wrapuptime)) {
            if (!is_null($wrapuptime)) {
                Assertion::integerish($wrapuptime, 'wrapuptime value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->wrapuptime = $wrapuptime;

        return $this;
    }

    /**
     * Get wrapuptime
     *
     * @return integer
     */
    public function getWrapuptime()
    {
        return $this->wrapuptime;
    }

    /**
     * @deprecated
     * Set maxlen
     *
     * @param integer $maxlen
     *
     * @return self
     */
    public function setMaxlen($maxlen = null)
    {
        if (!is_null($maxlen)) {
            if (!is_null($maxlen)) {
                Assertion::integerish($maxlen, 'maxlen value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->maxlen = $maxlen;

        return $this;
    }

    /**
     * Get maxlen
     *
     * @return integer
     */
    public function getMaxlen()
    {
        return $this->maxlen;
    }

    /**
     * @deprecated
     * Set strategy
     *
     * @param string $strategy
     *
     * @return self
     */
    public function setStrategy($strategy = null)
    {
        if (!is_null($strategy)) {
        }

        $this->strategy = $strategy;

        return $this;
    }

    /**
     * Get strategy
     *
     * @return string
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * @deprecated
     * Set weight
     *
     * @param integer $weight
     *
     * @return self
     */
    public function setWeight($weight = null)
    {
        if (!is_null($weight)) {
            if (!is_null($weight)) {
                Assertion::integerish($weight, 'weight value "%s" is not an integer or a number castable to integer.');
            }
        }

        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
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
     * @return self
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
