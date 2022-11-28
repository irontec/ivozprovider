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
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $periodicAnnounce = null;

    /**
     * @var int|null
     */
    private $periodicAnnounceFrequency = null;

    /**
     * @var string|null
     */
    private $announcePosition = 'no';

    /**
     * @var int|null
     */
    private $announceFrequency = null;

    /**
     * @var int|null
     */
    private $timeout = null;

    /**
     * @var string|null
     */
    private $autopause = 'no';

    /**
     * @var string|null
     */
    private $ringinuse = 'no';

    /**
     * @var int|null
     */
    private $wrapuptime = null;

    /**
     * @var int|null
     */
    private $maxlen = null;

    /**
     * @var string|null
     */
    private $strategy = null;

    /**
     * @var int|null
     */
    private $weight = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var QueueDto | null
     */
    private $queue = null;

    /**
     * @param string|int|null $id
     */
    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'name' => 'name',
            'periodicAnnounce' => 'periodicAnnounce',
            'periodicAnnounceFrequency' => 'periodicAnnounceFrequency',
            'announcePosition' => 'announcePosition',
            'announceFrequency' => 'announceFrequency',
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
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'name' => $this->getName(),
            'periodicAnnounce' => $this->getPeriodicAnnounce(),
            'periodicAnnounceFrequency' => $this->getPeriodicAnnounceFrequency(),
            'announcePosition' => $this->getAnnouncePosition(),
            'announceFrequency' => $this->getAnnounceFrequency(),
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setPeriodicAnnounce(?string $periodicAnnounce): static
    {
        $this->periodicAnnounce = $periodicAnnounce;

        return $this;
    }

    public function getPeriodicAnnounce(): ?string
    {
        return $this->periodicAnnounce;
    }

    public function setPeriodicAnnounceFrequency(?int $periodicAnnounceFrequency): static
    {
        $this->periodicAnnounceFrequency = $periodicAnnounceFrequency;

        return $this;
    }

    public function getPeriodicAnnounceFrequency(): ?int
    {
        return $this->periodicAnnounceFrequency;
    }

    public function setAnnouncePosition(?string $announcePosition): static
    {
        $this->announcePosition = $announcePosition;

        return $this;
    }

    public function getAnnouncePosition(): ?string
    {
        return $this->announcePosition;
    }

    public function setAnnounceFrequency(?int $announceFrequency): static
    {
        $this->announceFrequency = $announceFrequency;

        return $this;
    }

    public function getAnnounceFrequency(): ?int
    {
        return $this->announceFrequency;
    }

    public function setTimeout(?int $timeout): static
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function getTimeout(): ?int
    {
        return $this->timeout;
    }

    public function setAutopause(string $autopause): static
    {
        $this->autopause = $autopause;

        return $this;
    }

    public function getAutopause(): ?string
    {
        return $this->autopause;
    }

    public function setRinginuse(string $ringinuse): static
    {
        $this->ringinuse = $ringinuse;

        return $this;
    }

    public function getRinginuse(): ?string
    {
        return $this->ringinuse;
    }

    public function setWrapuptime(?int $wrapuptime): static
    {
        $this->wrapuptime = $wrapuptime;

        return $this;
    }

    public function getWrapuptime(): ?int
    {
        return $this->wrapuptime;
    }

    public function setMaxlen(?int $maxlen): static
    {
        $this->maxlen = $maxlen;

        return $this;
    }

    public function getMaxlen(): ?int
    {
        return $this->maxlen;
    }

    public function setStrategy(?string $strategy): static
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    public function setWeight(?int $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setQueue(?QueueDto $queue): static
    {
        $this->queue = $queue;

        return $this;
    }

    public function getQueue(): ?QueueDto
    {
        return $this->queue;
    }

    public function setQueueId($id): static
    {
        $value = !is_null($id)
            ? new QueueDto($id)
            : null;

        return $this->setQueue($value);
    }

    public function getQueueId()
    {
        if ($dto = $this->getQueue()) {
            return $dto->getId();
        }

        return null;
    }
}
