<?php

namespace Ivoz\Provider\Domain\Model\PickUpRelUser;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupDto;
use Ivoz\Provider\Domain\Model\User\UserDto;

/**
* PickUpRelUserDtoAbstract
* @codeCoverageIgnore
*/
abstract class PickUpRelUserDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $id;

    /**
     * @var PickUpGroupDto | null
     */
    private $pickUpGroup;

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
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'id' => 'id',
            'pickUpGroupId' => 'pickUpGroup',
            'userId' => 'user'
        ];
    }

    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'id' => $this->getId(),
            'pickUpGroup' => $this->getPickUpGroup(),
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

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPickUpGroup(?PickUpGroupDto $pickUpGroup): static
    {
        $this->pickUpGroup = $pickUpGroup;

        return $this;
    }

    public function getPickUpGroup(): ?PickUpGroupDto
    {
        return $this->pickUpGroup;
    }

    public function setPickUpGroupId($id): static
    {
        $value = !is_null($id)
            ? new PickUpGroupDto($id)
            : null;

        return $this->setPickUpGroup($value);
    }

    public function getPickUpGroupId()
    {
        if ($dto = $this->getPickUpGroup()) {
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
