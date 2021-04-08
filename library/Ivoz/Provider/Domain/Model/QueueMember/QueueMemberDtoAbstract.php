<?php

namespace Ivoz\Provider\Domain\Model\QueueMember;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Queue\QueueDto;
use Ivoz\Provider\Domain\Model\User\UserDto;

/**
* QueueMemberDtoAbstract
* @codeCoverageIgnore
*/
abstract class QueueMemberDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int|null
     */
    private $penalty;

    /**
     * @var int
     */
    private $id;

    /**
     * @var QueueDto | null
     */
    private $queue;

    /**
     * @var UserDto | null
     */
    private $user;

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
            'penalty' => 'penalty',
            'id' => 'id',
            'queueId' => 'queue',
            'userId' => 'user'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'penalty' => $this->getPenalty(),
            'id' => $this->getId(),
            'queue' => $this->getQueue(),
            'user' => $this->getUser()
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

    public function setPenalty(?int $penalty): static
    {
        $this->penalty = $penalty;

        return $this;
    }

    public function getPenalty(): ?int
    {
        return $this->penalty;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
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

    public function setUser(?UserDto $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserDto
    {
        return $this->user;
    }

    public function setUserId($id): static
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setUser($value);
    }

    public function getUserId()
    {
        if ($dto = $this->getUser()) {
            return $dto->getId();
        }

        return null;
    }
}
