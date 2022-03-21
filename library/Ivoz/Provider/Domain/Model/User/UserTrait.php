<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;

/**
* @codeCoverageIgnore
*/
trait UserTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var VoicemailInterface
     * mappedBy user
     */
    protected $voicemail;

    /**
     * @var Collection<array-key, PickUpRelUserInterface> & Selectable<array-key, PickUpRelUserInterface>
     * PickUpRelUserInterface mappedBy user
     * orphanRemoval
     */
    protected $pickUpRelUsers;

    /**
     * @var Collection<array-key, QueueMemberInterface> & Selectable<array-key, QueueMemberInterface>
     * QueueMemberInterface mappedBy user
     */
    protected $queueMembers;

    /**
     * @var Collection<array-key, CallForwardSettingInterface> & Selectable<array-key, CallForwardSettingInterface>
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
     * @param UserDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getVoicemail())) {
            /** @var VoicemailInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getVoicemail()
            );
            $self->setVoicemail($entity);
        }

        $pickUpRelUsers = $dto->getPickUpRelUsers();
        if (!is_null($pickUpRelUsers)) {

            /** @var Collection<array-key, PickUpRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $pickUpRelUsers
            );
            $self->replacePickUpRelUsers($replacement);
        }

        $queueMembers = $dto->getQueueMembers();
        if (!is_null($queueMembers)) {

            /** @var Collection<array-key, QueueMemberInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $queueMembers
            );
            $self->replaceQueueMembers($replacement);
        }

        $callForwardSettings = $dto->getCallForwardSettings();
        if (!is_null($callForwardSettings)) {

            /** @var Collection<array-key, CallForwardSettingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $callForwardSettings
            );
            $self->replaceCallForwardSettings($replacement);
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
     * @param UserDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getVoicemail())) {
            /** @var VoicemailInterface $entity */
            $entity = $fkTransformer->transform(
                $dto->getVoicemail()
            );
            $this->setVoicemail($entity);
        }

        $pickUpRelUsers = $dto->getPickUpRelUsers();
        if (!is_null($pickUpRelUsers)) {

            /** @var Collection<array-key, PickUpRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $pickUpRelUsers
            );
            $this->replacePickUpRelUsers($replacement);
        }

        $queueMembers = $dto->getQueueMembers();
        if (!is_null($queueMembers)) {

            /** @var Collection<array-key, QueueMemberInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $queueMembers
            );
            $this->replaceQueueMembers($replacement);
        }

        $callForwardSettings = $dto->getCallForwardSettings();
        if (!is_null($callForwardSettings)) {

            /** @var Collection<array-key, CallForwardSettingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $callForwardSettings
            );
            $this->replaceCallForwardSettings($replacement);
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

    public function setVoicemail(VoicemailInterface $voicemail): static
    {
        $this->voicemail = $voicemail;

        return $this;
    }

    public function getVoicemail(): ?VoicemailInterface
    {
        return $this->voicemail;
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

    /**
     * @param Collection<array-key, PickUpRelUserInterface> $pickUpRelUsers
     */
    public function replacePickUpRelUsers(Collection $pickUpRelUsers): UserInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($pickUpRelUsers as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setUser($this);
        }

        foreach ($this->pickUpRelUsers as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->pickUpRelUsers->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->pickUpRelUsers->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->pickUpRelUsers->remove($key);
            }
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

    /**
     * @param Collection<array-key, QueueMemberInterface> $queueMembers
     */
    public function replaceQueueMembers(Collection $queueMembers): UserInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($queueMembers as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setUser($this);
        }

        foreach ($this->queueMembers as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->queueMembers->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->queueMembers->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->queueMembers->remove($key);
            }
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

    /**
     * @param Collection<array-key, CallForwardSettingInterface> $callForwardSettings
     */
    public function replaceCallForwardSettings(Collection $callForwardSettings): UserInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($callForwardSettings as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setUser($this);
        }

        foreach ($this->callForwardSettings as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->callForwardSettings->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->callForwardSettings->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->callForwardSettings->remove($key);
            }
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
