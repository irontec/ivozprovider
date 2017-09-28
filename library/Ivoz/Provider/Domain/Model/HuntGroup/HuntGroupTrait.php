<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * HuntGroupTrait
 * @codeCoverageIgnore
 */
trait HuntGroupTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $huntGroupsRelUsers;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->huntGroupsRelUsers = new ArrayCollection();
    }

    /**
     * @return HuntGroupDTO
     */
    public static function createDTO()
    {
        return new HuntGroupDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto HuntGroupDTO
         */
        $self = parent::fromDTO($dto);
        if ($dto->getHuntGroupsRelUsers()) {
            $self->replaceHuntGroupsRelUsers($dto->getHuntGroupsRelUsers());
        }
        if ($dto->getId()) {
            $self->id = $dto->getId();
        }
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto HuntGroupDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getHuntGroupsRelUsers()) {
            $this->replaceHuntGroupsRelUsers($dto->getHuntGroupsRelUsers());
        }
        return $this;
    }

    /**
     * @return HuntGroupDTO
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
            'id' => $this->getId()
        ];
    }


    /**
     * Add huntGroupsRelUser
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface $huntGroupsRelUser
     *
     * @return HuntGroupTrait
     */
    public function addHuntGroupsRelUser(\Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface $huntGroupsRelUser)
    {
        $this->huntGroupsRelUsers->add($huntGroupsRelUser);

        return $this;
    }

    /**
     * Remove huntGroupsRelUser
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface $huntGroupsRelUser
     */
    public function removeHuntGroupsRelUser(\Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface $huntGroupsRelUser)
    {
        $this->huntGroupsRelUsers->removeElement($huntGroupsRelUser);
    }

    /**
     * Replace huntGroupsRelUsers
     *
     * @param \Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface[] $huntGroupsRelUsers
     * @return self
     */
    public function replaceHuntGroupsRelUsers(Collection $huntGroupsRelUsers)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($huntGroupsRelUsers as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setHuntGroup($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->huntGroupsRelUsers as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->huntGroupsRelUsers->set($key, $updatedEntities[$identity]);
            } else {
                $this->huntGroupsRelUsers->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addHuntGroupsRelUser($entity);
        }

        return $this;
    }

    /**
     * Get huntGroupsRelUsers
     *
     * @return array
     */
    public function getHuntGroupsRelUsers(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->huntGroupsRelUsers->matching($criteria)->toArray();
        }

        return $this->huntGroupsRelUsers->toArray();
    }


}

