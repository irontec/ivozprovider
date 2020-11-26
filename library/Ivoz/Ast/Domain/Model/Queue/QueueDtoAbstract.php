<?php

namespace Ivoz\Ast\Domain\Model\Queue;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Queue\QueueDto;

/**
* QueueDtoAbstract
* @codeCoverageIgnore
*/
abstract class QueueDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string | null
     */
    private $periodicAnnounce;

    /**
     * @var int | null
     */
    private $periodicAnnounceFrequency;

    /**
     * @var int | null
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
     * @var int | null
     */
    private $wrapuptime;

    /**
     * @var int | null
     */
    private $maxlen;

    /**
     * @var string | null
     */
    private $strategy;

    /**
     * @var int | null
     */
    private $weight;

    /**
     * @var int
     */
    private $id;

    /**
     * @var QueueDto | null
     */
    private $queue;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
        $response = [
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

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $periodicAnnounce | null
     *
     * @return static
     */
    public function setPeriodicAnnounce(?string $periodicAnnounce = null): self
    {
        $this->periodicAnnounce = $periodicAnnounce;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPeriodicAnnounce(): ?string
    {
        return $this->periodicAnnounce;
    }

    /**
     * @param int $periodicAnnounceFrequency | null
     *
     * @return static
     */
    public function setPeriodicAnnounceFrequency(?int $periodicAnnounceFrequency = null): self
    {
        $this->periodicAnnounceFrequency = $periodicAnnounceFrequency;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPeriodicAnnounceFrequency(): ?int
    {
        return $this->periodicAnnounceFrequency;
    }

    /**
     * @param int $timeout | null
     *
     * @return static
     */
    public function setTimeout(?int $timeout = null): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getTimeout(): ?int
    {
        return $this->timeout;
    }

    /**
     * @param string $autopause | null
     *
     * @return static
     */
    public function setAutopause(?string $autopause = null): self
    {
        $this->autopause = $autopause;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAutopause(): ?string
    {
        return $this->autopause;
    }

    /**
     * @param string $ringinuse | null
     *
     * @return static
     */
    public function setRinginuse(?string $ringinuse = null): self
    {
        $this->ringinuse = $ringinuse;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRinginuse(): ?string
    {
        return $this->ringinuse;
    }

    /**
     * @param int $wrapuptime | null
     *
     * @return static
     */
    public function setWrapuptime(?int $wrapuptime = null): self
    {
        $this->wrapuptime = $wrapuptime;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getWrapuptime(): ?int
    {
        return $this->wrapuptime;
    }

    /**
     * @param int $maxlen | null
     *
     * @return static
     */
    public function setMaxlen(?int $maxlen = null): self
    {
        $this->maxlen = $maxlen;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getMaxlen(): ?int
    {
        return $this->maxlen;
    }

    /**
     * @param string $strategy | null
     *
     * @return static
     */
    public function setStrategy(?string $strategy = null): self
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    /**
     * @param int $weight | null
     *
     * @return static
     */
    public function setWeight(?int $weight = null): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param QueueDto | null
     *
     * @return static
     */
    public function setQueue(?QueueDto $queue = null): self
    {
        $this->queue = $queue;

        return $this;
    }

    /**
     * @return QueueDto | null
     */
    public function getQueue(): ?QueueDto
    {
        return $this->queue;
    }

    /**
     * @return static
     */
    public function setQueueId($id): self
    {
        $value = !is_null($id)
            ? new QueueDto($id)
            : null;

        return $this->setQueue($value);
    }

    /**
     * @return mixed | null
     */
    public function getQueueId()
    {
        if ($dto = $this->getQueue()) {
            return $dto->getId();
        }

        return null;
    }

}
