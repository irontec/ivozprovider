<?php

namespace Ivoz\Provider\Domain\Model\User;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * UserTrait
 * @codeCoverageIgnore
 */
trait UserTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Contact\ContactInterface
     */
    protected $contact;

    /**
     * @var ArrayCollection
     */
    protected $pickUpRelUsers;

    /**
     * @var ArrayCollection
     */
    protected $queueMembers;

    /**
     * @var ArrayCollection
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UserDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param UserDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param int $depth
     * @return UserDto
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
     * Set contact
     *
     * @param \Ivoz\Provider\Domain\Model\Contact\ContactInterface $contact
     *
     * @return static
     */
    public function setContact(\Ivoz\Provider\Domain\Model\Contact\ContactInterface $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \Ivoz\Provider\Domain\Model\Contact\ContactInterface | null
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Add pickUpRelUser
     *
     * @param \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $pickUpRelUser
     *
     * @return static
     */
    public function addPickUpRelUser(\Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $pickUpRelUser)
    {
        $this->pickUpRelUsers->add($pickUpRelUser);

        return $this;
    }

    /**
     * Remove pickUpRelUser
     *
     * @param \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $pickUpRelUser
     */
    public function removePickUpRelUser(\Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $pickUpRelUser)
    {
        $this->pickUpRelUsers->removeElement($pickUpRelUser);
    }

    /**
     * Replace pickUpRelUsers
     *
     * @param ArrayCollection $pickUpRelUsers of Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface
     * @return static
     */
    public function replacePickUpRelUsers(ArrayCollection $pickUpRelUsers)
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

    /**
     * Get pickUpRelUsers
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface[]
     */
    public function getPickUpRelUsers(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->pickUpRelUsers->matching($criteria)->toArray();
        }

        return $this->pickUpRelUsers->toArray();
    }

    /**
     * Add queueMember
     *
     * @param \Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface $queueMember
     *
     * @return static
     */
    public function addQueueMember(\Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface $queueMember)
    {
        $this->queueMembers->add($queueMember);

        return $this;
    }

    /**
     * Remove queueMember
     *
     * @param \Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface $queueMember
     */
    public function removeQueueMember(\Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface $queueMember)
    {
        $this->queueMembers->removeElement($queueMember);
    }

    /**
     * Replace queueMembers
     *
     * @param ArrayCollection $queueMembers of Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface
     * @return static
     */
    public function replaceQueueMembers(ArrayCollection $queueMembers)
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

    /**
     * Get queueMembers
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\QueueMember\QueueMemberInterface[]
     */
    public function getQueueMembers(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->queueMembers->matching($criteria)->toArray();
        }

        return $this->queueMembers->toArray();
    }

    /**
     * Add callForwardSetting
     *
     * @param \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface $callForwardSetting
     *
     * @return static
     */
    public function addCallForwardSetting(\Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface $callForwardSetting)
    {
        $this->callForwardSettings->add($callForwardSetting);

        return $this;
    }

    /**
     * Remove callForwardSetting
     *
     * @param \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface $callForwardSetting
     */
    public function removeCallForwardSetting(\Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface $callForwardSetting)
    {
        $this->callForwardSettings->removeElement($callForwardSetting);
    }

    /**
     * Replace callForwardSettings
     *
     * @param ArrayCollection $callForwardSettings of Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface
     * @return static
     */
    public function replaceCallForwardSettings(ArrayCollection $callForwardSettings)
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

    /**
     * Get callForwardSettings
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface[]
     */
    public function getCallForwardSettings(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->callForwardSettings->matching($criteria)->toArray();
        }

        return $this->callForwardSettings->toArray();
    }
}
