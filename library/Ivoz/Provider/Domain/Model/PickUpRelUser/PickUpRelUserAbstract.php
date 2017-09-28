<?php

namespace Ivoz\Provider\Domain\Model\PickUpRelUser;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * PickUpRelUserAbstract
 * @codeCoverageIgnore
 */
abstract class PickUpRelUserAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface
     */
    protected $pickUpGroup;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $user;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $this->_initialValues = $this->__toArray();
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
     * @return PickUpRelUserDTO
     */
    public static function createDTO()
    {
        return new PickUpRelUserDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PickUpRelUserDTO
         */
        Assertion::isInstanceOf($dto, PickUpRelUserDTO::class);

        $self = new static();

        return $self
            ->setPickUpGroup($dto->getPickUpGroup())
            ->setUser($dto->getUser())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PickUpRelUserDTO
         */
        Assertion::isInstanceOf($dto, PickUpRelUserDTO::class);

        $this
            ->setPickUpGroup($dto->getPickUpGroup())
            ->setUser($dto->getUser());


        return $this;
    }

    /**
     * @return PickUpRelUserDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setPickUpGroupId($this->getPickUpGroup() ? $this->getPickUpGroup()->getId() : null)
            ->setUserId($this->getUser() ? $this->getUser()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'pickUpGroupId' => $this->getPickUpGroup() ? $this->getPickUpGroup()->getId() : null,
            'userId' => $this->getUser() ? $this->getUser()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set pickUpGroup
     *
     * @param \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface $pickUpGroup
     *
     * @return self
     */
    public function setPickUpGroup(\Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface $pickUpGroup = null)
    {
        $this->pickUpGroup = $pickUpGroup;

        return $this;
    }

    /**
     * Get pickUpGroup
     *
     * @return \Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface
     */
    public function getPickUpGroup()
    {
        return $this->pickUpGroup;
    }

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return self
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }



    // @codeCoverageIgnoreEnd
}

