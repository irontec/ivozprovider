<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait HuntGroupTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * HuntGroupsRelUserInterface mappedBy huntGroup
     * orphanRemoval
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

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getHuntGroupsRelUsers())) {
            $self->replaceHuntGroupsRelUsers(
                $fkTransformer->transformCollection(
                    $dto->getHuntGroupsRelUsers()
                )
            );
        }

        $self->sanitizeValues();
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getHuntGroupsRelUsers())) {
            $this->replaceHuntGroupsRelUsers(
                $fkTransformer->transformCollection(
                    $dto->getHuntGroupsRelUsers()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): HuntGroupDto
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    protected function __toArray(): array
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    public function addHuntGroupsRelUser(HuntGroupsRelUserInterface $huntGroupsRelUser): HuntGroupInterface
    {
        $this->huntGroupsRelUsers->add($huntGroupsRelUser);

        return $this;
    }

    public function removeHuntGroupsRelUser(HuntGroupsRelUserInterface $huntGroupsRelUser): HuntGroupInterface
    {
        $this->huntGroupsRelUsers->removeElement($huntGroupsRelUser);

        return $this;
    }

    public function replaceHuntGroupsRelUsers(ArrayCollection $huntGroupsRelUsers): HuntGroupInterface
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

    public function getHuntGroupsRelUsers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->huntGroupsRelUsers->matching($criteria)->toArray();
        }

        return $this->huntGroupsRelUsers->toArray();
    }
}
