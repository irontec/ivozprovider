<?php

namespace Ivoz\Provider\Domain\Model\PickUpGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * PickUpGroupTrait
 * @codeCoverageIgnore
 */
trait PickUpGroupTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $relUsers;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->relUsers = new ArrayCollection();
    }

    /**
     * @return PickUpGroupDTO
     */
    public static function createDTO()
    {
        return new PickUpGroupDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto PickUpGroupDTO
         */
        $self = parent::fromDTO($dto);
        if ($dto->getRelUsers()) {
            $self->replaceRelUsers($dto->getRelUsers());
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
         * @var $dto PickUpGroupDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getRelUsers()) {
            $this->replaceRelUsers($dto->getRelUsers());
        }
        return $this;
    }

    /**
     * @return PickUpGroupDTO
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
     * Add relUser
     *
     * @param \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $relUser
     *
     * @return PickUpGroupTrait
     */
    public function addRelUser(\Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $relUser)
    {
        $this->relUsers->add($relUser);

        return $this;
    }

    /**
     * Remove relUser
     *
     * @param \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $relUser
     */
    public function removeRelUser(\Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $relUser)
    {
        $this->relUsers->removeElement($relUser);
    }

    /**
     * Replace relUsers
     *
     * @param \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface[] $relUsers
     * @return self
     */
    public function replaceRelUsers(Collection $relUsers)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relUsers as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setPickUpGroup($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relUsers as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relUsers->set($key, $updatedEntities[$identity]);
            } else {
                $this->relUsers->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelUser($entity);
        }

        return $this;
    }

    /**
     * Get relUsers
     *
     * @return array
     */
    public function getRelUsers(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relUsers->matching($criteria)->toArray();
        }

        return $this->relUsers->toArray();
    }


}

