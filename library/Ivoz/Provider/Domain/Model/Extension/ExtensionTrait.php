<?php

namespace Ivoz\Provider\Domain\Model\Extension;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * ExtensionTrait
 * @codeCoverageIgnore
 */
trait ExtensionTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $users;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->users = new ArrayCollection();
    }

    /**
     * @return ExtensionDTO
     */
    public static function createDTO()
    {
        return new ExtensionDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ExtensionDTO
         */
        $self = parent::fromDTO($dto);
        if ($dto->getUsers()) {
            $self->replaceUsers($dto->getUsers());
        }
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ExtensionDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getUsers()) {
            $this->replaceUsers($dto->getUsers());
        }
        return $this;
    }

    /**
     * @return ExtensionDTO
     */
    public function toDTO()
    {
        $dto = parent::toDTO();
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }


    /**
     * Add user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return ExtensionTrait
     */
    public function addUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user)
    {
        $this->users->add($user);

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     */
    public function removeUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Replace users
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface[] $users
     * @return self
     */
    public function replaceUsers(Collection $users)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($users as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setExtension($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->users as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->users->set($key, $updatedEntities[$identity]);
            } else {
                $this->users->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addUser($entity);
        }

        return $this;
    }

    /**
     * Get users
     *
     * @return array
     */
    public function getUsers(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->users->matching($criteria)->toArray();
        }

        return $this->users->toArray();
    }


}

