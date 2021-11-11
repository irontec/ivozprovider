<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait HuntGroupTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, HuntGroupsRelUserInterface> & Selectable<array-key, HuntGroupsRelUserInterface>
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
     * @param HuntGroupDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $huntGroupsRelUsers = $dto->getHuntGroupsRelUsers();
        if (!is_null($huntGroupsRelUsers)) {

            /** @var Collection<array-key, HuntGroupsRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $huntGroupsRelUsers
            );
            $self->replaceHuntGroupsRelUsers($replacement);
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
     * @param HuntGroupDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $huntGroupsRelUsers = $dto->getHuntGroupsRelUsers();
        if (!is_null($huntGroupsRelUsers)) {

            /** @var Collection<array-key, HuntGroupsRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $huntGroupsRelUsers
            );
            $this->replaceHuntGroupsRelUsers($replacement);
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

    /**
     * @param Collection<array-key, HuntGroupsRelUserInterface> $huntGroupsRelUsers
     */
    public function replaceHuntGroupsRelUsers(Collection $huntGroupsRelUsers): HuntGroupInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($huntGroupsRelUsers as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setHuntGroup($this);
        }

        foreach ($this->huntGroupsRelUsers as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->huntGroupsRelUsers->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->huntGroupsRelUsers->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->huntGroupsRelUsers->remove($key);
            }
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
