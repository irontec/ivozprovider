<?php

namespace Ivoz\Provider\Domain\Model\HuntGroupsRelUser;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * HuntGroupsRelUserAbstract
 * @codeCoverageIgnore
 */
abstract class HuntGroupsRelUserAbstract
{
    /**
     * @var integer
     */
    protected $timeoutTime;

    /**
     * @var integer
     */
    protected $priority;

    /**
     * @var \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface
     */
    protected $huntGroup;

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


        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
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
     * @return HuntGroupsRelUserDTO
     */
    public static function createDTO()
    {
        return new HuntGroupsRelUserDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto HuntGroupsRelUserDTO
         */
        Assertion::isInstanceOf($dto, HuntGroupsRelUserDTO::class);

        $self = new static();

        return $self
            ->setTimeoutTime($dto->getTimeoutTime())
            ->setPriority($dto->getPriority())
            ->setHuntGroup($dto->getHuntGroup())
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
         * @var $dto HuntGroupsRelUserDTO
         */
        Assertion::isInstanceOf($dto, HuntGroupsRelUserDTO::class);

        $this
            ->setTimeoutTime($dto->getTimeoutTime())
            ->setPriority($dto->getPriority())
            ->setHuntGroup($dto->getHuntGroup())
            ->setUser($dto->getUser());


        return $this;
    }

    /**
     * @return HuntGroupsRelUserDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setTimeoutTime($this->getTimeoutTime())
            ->setPriority($this->getPriority())
            ->setHuntGroupId($this->getHuntGroup() ? $this->getHuntGroup()->getId() : null)
            ->setUserId($this->getUser() ? $this->getUser()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'timeoutTime' => self::getTimeoutTime(),
            'priority' => self::getPriority(),
            'huntGroupId' => self::getHuntGroup() ? self::getHuntGroup()->getId() : null,
            'userId' => self::getUser() ? self::getUser()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set timeoutTime
     *
     * @param integer $timeoutTime
     *
     * @return self
     */
    public function setTimeoutTime($timeoutTime = null)
    {
        if (!is_null($timeoutTime)) {
            if (!is_null($timeoutTime)) {
                Assertion::integerish($timeoutTime);
            }
        }

        $this->timeoutTime = $timeoutTime;

        return $this;
    }

    /**
     * Get timeoutTime
     *
     * @return integer
     */
    public function getTimeoutTime()
    {
        return $this->timeoutTime;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    public function setPriority($priority = null)
    {
        if (!is_null($priority)) {
            if (!is_null($priority)) {
                Assertion::integerish($priority);
            }
        }

        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set huntGroup
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup
     *
     * @return self
     */
    public function setHuntGroup(\Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface $huntGroup = null)
    {
        $this->huntGroup = $huntGroup;

        return $this;
    }

    /**
     * Get huntGroup
     *
     * @return \Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface
     */
    public function getHuntGroup()
    {
        return $this->huntGroup;
    }

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return self
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user)
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

