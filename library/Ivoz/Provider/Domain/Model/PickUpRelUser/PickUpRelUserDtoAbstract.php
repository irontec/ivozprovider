<?php

namespace Ivoz\Provider\Domain\Model\PickUpRelUser;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class PickUpRelUserDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupDto | null
     */
    private $pickUpGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserDto | null
     */
    private $user;


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
        return [
            'id' => $this->getId(),
            'pickUpGroup' => $this->getPickUpGroup(),
            'user' => $this->getUser()
        ];
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
     * @param \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupDto $pickUpGroup
     *
     * @return static
     */
    public function setPickUpGroup(\Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupDto $pickUpGroup = null)
    {
        $this->pickUpGroup = $pickUpGroup;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupDto
     */
    public function getPickUpGroup()
    {
        return $this->pickUpGroup;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setPickUpGroupId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupDto($id)
            : null;

        return $this->setPickUpGroup($value);
    }

    /**
     * @return integer | null
     */
    public function getPickUpGroupId()
    {
        if ($dto = $this->getPickUpGroup()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\User\UserDto $user
     *
     * @return static
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserDto $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\User\UserDto
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setUserId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\User\UserDto($id)
            : null;

        return $this->setUser($value);
    }

    /**
     * @return integer | null
     */
    public function getUserId()
    {
        if ($dto = $this->getUser()) {
            return $dto->getId();
        }

        return null;
    }
}
