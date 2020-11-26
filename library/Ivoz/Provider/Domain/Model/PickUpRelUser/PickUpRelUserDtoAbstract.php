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
    public static function getPropertyMap(string $context = '', string $role = null)
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

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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
     * @param PickUpGroupDto | null
     *
     * @return static
     */
    public function setPickUpGroup(?PickUpGroupDto $pickUpGroup = null): self
    {
        $this->pickUpGroup = $pickUpGroup;

        return $this;
    }

    /**
     * @return PickUpGroupDto | null
     */
    public function getPickUpGroup(): ?PickUpGroupDto
    {
        return $this->pickUpGroup;
    }

    /**
     * @return static
     */
    public function setPickUpGroupId($id): self
    {
        $value = !is_null($id)
            ? new PickUpGroupDto($id)
            : null;

        return $this->setPickUpGroup($value);
    }

    /**
     * @return mixed | null
     */
    public function getPickUpGroupId()
    {
        if ($dto = $this->getPickUpGroup()) {
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
