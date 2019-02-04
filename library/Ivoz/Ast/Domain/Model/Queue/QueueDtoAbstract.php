<?php

namespace Ivoz\Ast\Domain\Model\Queue;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class QueueDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $periodicAnnounce;

    /**
     * @var integer
     */
    private $periodicAnnounceFrequency;

    /**
     * @var integer
     */
    private $timeout;

    /**
     * @var string
     */
    private $autopause = 'no';

    /**
     * @var string
     */
    private $ringinuse = 'no';

    /**
     * @var integer
     */
    private $wrapuptime;

    /**
     * @var integer
     */
    private $maxlen;

    /**
     * @var string
     */
    private $strategy;

    /**
     * @var integer
     */
    private $weight;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Queue\QueueDto | null
     */
    private $queue;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'name' => 'name',
            'periodicAnnounce' => 'periodicAnnounce',
            'periodicAnnounceFrequency' => 'periodicAnnounceFrequency',
            'timeout' => 'timeout',
            'autopause' => 'autopause',
            'ringinuse' => 'ringinuse',
            'wrapuptime' => 'wrapuptime',
            'maxlen' => 'maxlen',
            'strategy' => 'strategy',
            'weight' => 'weight',
            'id' => 'id',
            'queueId' => 'queue'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'name' => $this->getName(),
            'periodicAnnounce' => $this->getPeriodicAnnounce(),
            'periodicAnnounceFrequency' => $this->getPeriodicAnnounceFrequency(),
            'timeout' => $this->getTimeout(),
            'autopause' => $this->getAutopause(),
            'ringinuse' => $this->getRinginuse(),
            'wrapuptime' => $this->getWrapuptime(),
            'maxlen' => $this->getMaxlen(),
            'strategy' => $this->getStrategy(),
            'weight' => $this->getWeight(),
            'id' => $this->getId(),
            'queue' => $this->getQueue()
        ];
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $periodicAnnounce
     *
     * @return static
     */
    public function setPeriodicAnnounce($periodicAnnounce = null)
    {
        $this->periodicAnnounce = $periodicAnnounce;

        return $this;
    }

    /**
     * @return string
     */
    public function getPeriodicAnnounce()
    {
        return $this->periodicAnnounce;
    }

    /**
     * @param integer $periodicAnnounceFrequency
     *
     * @return static
     */
    public function setPeriodicAnnounceFrequency($periodicAnnounceFrequency = null)
    {
        $this->periodicAnnounceFrequency = $periodicAnnounceFrequency;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPeriodicAnnounceFrequency()
    {
        return $this->periodicAnnounceFrequency;
    }

    /**
     * @param integer $timeout
     *
     * @return static
     */
    public function setTimeout($timeout = null)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param string $autopause
     *
     * @return static
     */
    public function setAutopause($autopause = null)
    {
        $this->autopause = $autopause;

        return $this;
    }

    /**
     * @return string
     */
    public function getAutopause()
    {
        return $this->autopause;
    }

    /**
     * @param string $ringinuse
     *
     * @return static
     */
    public function setRinginuse($ringinuse = null)
    {
        $this->ringinuse = $ringinuse;

        return $this;
    }

    /**
     * @return string
     */
    public function getRinginuse()
    {
        return $this->ringinuse;
    }

    /**
     * @param integer $wrapuptime
     *
     * @return static
     */
    public function setWrapuptime($wrapuptime = null)
    {
        $this->wrapuptime = $wrapuptime;

        return $this;
    }

    /**
     * @return integer
     */
    public function getWrapuptime()
    {
        return $this->wrapuptime;
    }

    /**
     * @param integer $maxlen
     *
     * @return static
     */
    public function setMaxlen($maxlen = null)
    {
        $this->maxlen = $maxlen;

        return $this;
    }

    /**
     * @return integer
     */
    public function getMaxlen()
    {
        return $this->maxlen;
    }

    /**
     * @param string $strategy
     *
     * @return static
     */
    public function setStrategy($strategy = null)
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * @return string
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * @param integer $weight
     *
     * @return static
     */
    public function setWeight($weight = null)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Queue\QueueDto $queue
     *
     * @return static
     */
    public function setQueue(\Ivoz\Provider\Domain\Model\Queue\QueueDto $queue = null)
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Queue\QueueDto
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setQueueId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Queue\QueueDto($id)
            : null;

        return $this->setQueue($value);
    }

    /**
     * @return integer | null
     */
    public function getQueueId()
    {
        if ($dto = $this->getQueue()) {
            return $dto->getId();
        }

        return null;
    }
}
