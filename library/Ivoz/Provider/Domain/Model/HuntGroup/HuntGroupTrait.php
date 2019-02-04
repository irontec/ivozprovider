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
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->huntGroupsRelUsers = new ArrayCollection();
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto HuntGroupDto
         */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getHuntGroupsRelUsers())) {
            $self->replaceHuntGroupsRelUsers(
                $fkTransformer->transformCollection(
                    $dto->getHuntGroupsRelUsers()
                )
            );
        }
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto HuntGroupDto
         */
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getHuntGroupsRelUsers())) {
            $this->replaceHuntGroupsRelUsers(
                $fkTransformer->transformCollection(
                    $dto->getHuntGroupsRelUsers()
                )
            );
        }
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return HuntGroupDto
     */
    public function toDto($depth = 0)
    {
        $dto = parent::toDto($depth);
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
     * @return \Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface[]
     */
    public function getHuntGroupsRelUsers(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->huntGroupsRelUsers->matching($criteria)->toArray();
        }

        return $this->huntGroupsRelUsers->toArray();
    }
}
