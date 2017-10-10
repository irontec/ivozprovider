<?php

namespace Ivoz\Ast\Domain\Model\Queue;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * QueueAbstract
 * @codeCoverageIgnore
 */
abstract class QueueAbstract
{
    /**
     * @column periodic_announce
     * @var string
     */
    protected $periodicAnnounce;

    /**
     * @column periodic_announce_frequency
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


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($autopause, $ringinuse)
    {
        $this->setAutopause($autopause);
        $this->setRinginuse($ringinuse);

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
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
    }

    /**
     * @return QueueDTO
     */
    public static function createDTO()
    {
        return new QueueDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto QueueDTO
         */
        Assertion::isInstanceOf($dto, QueueDTO::class);

        $self = new static(
            $dto->getAutopause(),
            $dto->getRinginuse());

        return $self
            ->setPeriodicAnnounce($dto->getPeriodicAnnounce())
            ->setPeriodicAnnounceFrequency($dto->getPeriodicAnnounceFrequency())
            ->setTimeout($dto->getTimeout())
            ->setWrapuptime($dto->getWrapuptime())
            ->setMaxlen($dto->getMaxlen())
            ->setStrategy($dto->getStrategy())
            ->setWeight($dto->getWeight())
            ->setQueue($dto->getQueue())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto QueueDTO
         */
        Assertion::isInstanceOf($dto, QueueDTO::class);

        $this
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


        return $this;
    }

    /**
     * @return QueueDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setPeriodicAnnounce($this->getPeriodicAnnounce())
            ->setPeriodicAnnounceFrequency($this->getPeriodicAnnounceFrequency())
            ->setTimeout($this->getTimeout())
            ->setAutopause($this->getAutopause())
            ->setRinginuse($this->getRinginuse())
            ->setWrapuptime($this->getWrapuptime())
            ->setMaxlen($this->getMaxlen())
            ->setStrategy($this->getStrategy())
            ->setWeight($this->getWeight())
            ->setQueueId($this->getQueue() ? $this->getQueue()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'periodicAnnounce' => self::getPeriodicAnnounce(),
            'periodicAnnounceFrequency' => self::getPeriodicAnnounceFrequency(),
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
     * Set periodicAnnounce
     *
     * @param string $periodicAnnounce
     *
     * @return self
     */
    public function setPeriodicAnnounce($periodicAnnounce = null)
    {
        if (!is_null($periodicAnnounce)) {
            Assertion::maxLength($periodicAnnounce, 128);
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
                Assertion::integerish($periodicAnnounceFrequency);
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
                Assertion::integerish($timeout);
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
     * Set autopause
     *
     * @param string $autopause
     *
     * @return self
     */
    public function setAutopause($autopause)
    {
        Assertion::notNull($autopause);

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
     * @return self
     */
    public function setRinginuse($ringinuse)
    {
        Assertion::notNull($ringinuse);

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
     * @param integer $wrapuptime
     *
     * @return self
     */
    public function setWrapuptime($wrapuptime = null)
    {
        if (!is_null($wrapuptime)) {
            if (!is_null($wrapuptime)) {
                Assertion::integerish($wrapuptime);
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
                Assertion::integerish($maxlen);
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
                Assertion::integerish($weight);
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

