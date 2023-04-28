<?php

namespace Ivoz\Ast\Domain\Model\QueueMember;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberDto;

/**
* QueueMemberDtoAbstract
* @codeCoverageIgnore
*/
abstract class QueueMemberDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $uniqueid = null;

    /**
     * @var string|null
     */
    private $queueName = null;

    /**
     * @var string|null
     */
    private $interface = null;

    /**
     * @var string|null
     */
    private $membername = null;

    /**
     * @var string|null
     */
    private $stateInterface = null;

    /**
     * @var int|null
     */
    private $penalty = null;

    /**
     * @var int|null
     */
    private $paused = 0;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var QueueMemberDto | null
     */
    private $queueMember = null;

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
            'uniqueid' => 'uniqueid',
            'queueName' => 'queueName',
            'interface' => 'interface',
            'membername' => 'membername',
            'stateInterface' => 'stateInterface',
            'penalty' => 'penalty',
            'paused' => 'paused',
            'id' => 'id',
            'queueMemberId' => 'queueMember'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'uniqueid' => $this->getUniqueid(),
            'queueName' => $this->getQueueName(),
            'interface' => $this->getInterface(),
            'membername' => $this->getMembername(),
            'stateInterface' => $this->getStateInterface(),
            'penalty' => $this->getPenalty(),
            'paused' => $this->getPaused(),
            'id' => $this->getId(),
            'queueMember' => $this->getQueueMember()
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

    public function setUniqueid(string $uniqueid): static
    {
        $this->uniqueid = $uniqueid;

        return $this;
    }

    public function getUniqueid(): ?string
    {
        return $this->uniqueid;
    }

    public function setQueueName(string $queueName): static
    {
        $this->queueName = $queueName;

        return $this;
    }

    public function getQueueName(): ?string
    {
        return $this->queueName;
    }

    public function setInterface(string $interface): static
    {
        $this->interface = $interface;

        return $this;
    }

    public function getInterface(): ?string
    {
        return $this->interface;
    }

    public function setMembername(string $membername): static
    {
        $this->membername = $membername;

        return $this;
    }

    public function getMembername(): ?string
    {
        return $this->membername;
    }

    public function setStateInterface(string $stateInterface): static
    {
        $this->stateInterface = $stateInterface;

        return $this;
    }

    public function getStateInterface(): ?string
    {
        return $this->stateInterface;
    }

    public function setPenalty(int $penalty): static
    {
        $this->penalty = $penalty;

        return $this;
    }

    public function getPenalty(): ?int
    {
        return $this->penalty;
    }

    public function setPaused(int $paused): static
    {
        $this->paused = $paused;

        return $this;
    }

    public function getPaused(): ?int
    {
        return $this->paused;
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

    public function setQueueMember(?QueueMemberDto $queueMember): static
    {
        $this->queueMember = $queueMember;

        return $this;
    }

    public function getQueueMember(): ?QueueMemberDto
    {
        return $this->queueMember;
    }

    public function setQueueMemberId($id): static
    {
        $value = !is_null($id)
            ? new QueueMemberDto($id)
            : null;

        return $this->setQueueMember($value);
    }

    public function getQueueMemberId()
    {
        if ($dto = $this->getQueueMember()) {
            return $dto->getId();
        }

        return null;
    }
}
