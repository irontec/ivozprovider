<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\HuntGroupMember\HuntGroupMemberInterface;
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
     * @var Collection<array-key, HuntGroupMemberInterface> & Selectable<array-key, HuntGroupMemberInterface>
     * HuntGroupMemberInterface mappedBy huntGroup
     * orphanRemoval
     */
    protected $huntGroupMembers;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->huntGroupMembers = new ArrayCollection();
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
        $huntGroupMembers = $dto->getHuntGroupMembers();
        if (!is_null($huntGroupMembers)) {

            /** @var Collection<array-key, HuntGroupMemberInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $huntGroupMembers
            );
            $self->replaceHuntGroupMembers($replacement);
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
        $huntGroupMembers = $dto->getHuntGroupMembers();
        if (!is_null($huntGroupMembers)) {

            /** @var Collection<array-key, HuntGroupMemberInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $huntGroupMembers
            );
            $this->replaceHuntGroupMembers($replacement);
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

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    public function addHuntGroupMember(HuntGroupMemberInterface $huntGroupMember): HuntGroupInterface
    {
        $this->huntGroupMembers->add($huntGroupMember);

        return $this;
    }

    public function removeHuntGroupMember(HuntGroupMemberInterface $huntGroupMember): HuntGroupInterface
    {
        $this->huntGroupMembers->removeElement($huntGroupMember);

        return $this;
    }

    /**
     * @param Collection<array-key, HuntGroupMemberInterface> $huntGroupMembers
     */
    public function replaceHuntGroupMembers(Collection $huntGroupMembers): HuntGroupInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($huntGroupMembers as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setHuntGroup($this);
        }

        foreach ($this->huntGroupMembers as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->huntGroupMembers->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->huntGroupMembers->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->huntGroupMembers->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addHuntGroupMember($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, HuntGroupMemberInterface>
     */
    public function getHuntGroupMembers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->huntGroupMembers->matching($criteria)->toArray();
        }

        return $this->huntGroupMembers->toArray();
    }
}
