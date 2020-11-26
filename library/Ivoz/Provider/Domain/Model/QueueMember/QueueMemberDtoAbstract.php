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
     * @var int | null
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

    /**
     * @param int $penalty | null
     *
     * @return static
     */
    public function setPenalty(?int $penalty = null): self
    {
        $this->penalty = $penalty;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPenalty(): ?int
    {
        return $this->penalty;
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

    /**
     * @param UserDto | null
     *
     * @return static
     */
    public function setUser(?UserDto $user = null): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return UserDto | null
     */
    public function getUser(): ?UserDto
    {
        return $this->user;
    }

    /**
     * @return static
     */
    public function setUserId($id): self
    {
        $value = !is_null($id)
            ? new UserDto($id)
            : null;

        return $this->setUser($value);
    }

    /**
     * @return mixed | null
     */
    public function getUserId()
    {
        if ($dto = $this->getUser()) {
            return $dto->getId();
        }

        return null;
    }

}
