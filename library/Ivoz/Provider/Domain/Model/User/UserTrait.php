<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;

/**
* @codeCoverageIgnore
*/
trait UserTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * PickUpRelUserInterface mappedBy user
     * orphanRemoval
     */
    protected $pickUpRelUsers;

    /**
     * @var ArrayCollection
     * QueueMemberInterface mappedBy user
     */
    protected $queueMembers;

    /**
     * @var ArrayCollection
     * CallForwardSettingInterface mappedBy user
     */
    protected $callForwardSettings;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->pickUpRelUsers = new ArrayCollection();
        $this->queueMembers = new ArrayCollection();
        $this->callForwardSettings = new ArrayCollection();
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
        if (!is_null($dto->getPickUpRelUsers())) {
            $self->replacePickUpRelUsers(
                $fkTransformer->transformCollection(
                    $dto->getPickUpRelUsers()
                )
            );
        }

        if (!is_null($dto->getQueueMembers())) {
            $self->replaceQueueMembers(
                $fkTransformer->transformCollection(
                    $dto->getQueueMembers()
                )
            );
        }

        if (!is_null($dto->getCallForwardSettings())) {
            $self->replaceCallForwardSettings(
                $fkTransformer->transformCollection(
                    $dto->getCallForwardSettings()
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
        if (!is_null($dto->getPickUpRelUsers())) {
            $this->replacePickUpRelUsers(
                $fkTransformer->transformCollection(
                    $dto->getPickUpRelUsers()
                )
            );
        }

        if (!is_null($dto->getQueueMembers())) {
            $this->replaceQueueMembers(
                $fkTransformer->transformCollection(
                    $dto->getQueueMembers()
                )
            );
        }

        if (!is_null($dto->getCallForwardSettings())) {
            $this->replaceCallForwardSettings(
                $fkTransformer->transformCollection(
                    $dto->getCallForwardSettings()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): UserDto
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

    public function addPickUpRelUser(PickUpRelUserInterface $pickUpRelUser): UserInterface
    {
        $this->pickUpRelUsers->add($pickUpRelUser);

        return $this;
    }

    public function removePickUpRelUser(PickUpRelUserInterface $pickUpRelUser): UserInterface
    {
        $this->pickUpRelUsers->removeElement($pickUpRelUser);

        return $this;
    }

    public function replacePickUpRelUsers(ArrayCollection $pickUpRelUsers): UserInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($pickUpRelUsers as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setUser($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->pickUpRelUsers as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->pickUpRelUsers->set($key, $updatedEntities[$identity]);
            } else {
                $this->pickUpRelUsers->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addPickUpRelUser($entity);
        }

        return $this;
    }

    public function getPickUpRelUsers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->pickUpRelUsers->matching($criteria)->toArray();
        }

        return $this->pickUpRelUsers->toArray();
    }

    public function addQueueMember(QueueMemberInterface $queueMember): UserInterface
    {
        $this->queueMembers->add($queueMember);

        return $this;
    }

    public function removeQueueMember(QueueMemberInterface $queueMember): UserInterface
    {
        $this->queueMembers->removeElement($queueMember);

        return $this;
    }

    public function replaceQueueMembers(ArrayCollection $queueMembers): UserInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($queueMembers as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setUser($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->queueMembers as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->queueMembers->set($key, $updatedEntities[$identity]);
            } else {
                $this->queueMembers->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addQueueMember($entity);
        }

        return $this;
    }

    public function getQueueMembers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->queueMembers->matching($criteria)->toArray();
        }

        return $this->queueMembers->toArray();
    }

    public function addCallForwardSetting(CallForwardSettingInterface $callForwardSetting): UserInterface
    {
        $this->callForwardSettings->add($callForwardSetting);

        return $this;
    }

    public function removeCallForwardSetting(CallForwardSettingInterface $callForwardSetting): UserInterface
    {
        $this->callForwardSettings->removeElement($callForwardSetting);

        return $this;
    }

    public function replaceCallForwardSettings(ArrayCollection $callForwardSettings): UserInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($callForwardSettings as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setUser($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->callForwardSettings as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->callForwardSettings->set($key, $updatedEntities[$identity]);
            } else {
                $this->callForwardSettings->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addCallForwardSetting($entity);
        }

        return $this;
    }

    public function getCallForwardSettings(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->callForwardSettings->matching($criteria)->toArray();
        }

        return $this->callForwardSettings->toArray();
    }
}
