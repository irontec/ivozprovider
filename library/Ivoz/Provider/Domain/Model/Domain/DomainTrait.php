<?php

namespace Ivoz\Provider\Domain\Model\Domain;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * DomainTrait
 * @codeCoverageIgnore
 */
trait DomainTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $friends;

    /**
     * @var Collection
     */
    protected $residentialDevices;

    /**
     * @var Collection
     */
    protected $terminals;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->friends = new ArrayCollection();
        $this->residentialDevices = new ArrayCollection();
        $this->terminals = new ArrayCollection();
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
         * @var $dto DomainDto
         */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getFriends())) {
            $self->replaceFriends(
                $fkTransformer->transformCollection(
                    $dto->getFriends()
                )
            );
        }

        if (!is_null($dto->getResidentialDevices())) {
            $self->replaceResidentialDevices(
                $fkTransformer->transformCollection(
                    $dto->getResidentialDevices()
                )
            );
        }

        if (!is_null($dto->getTerminals())) {
            $self->replaceTerminals(
                $fkTransformer->transformCollection(
                    $dto->getTerminals()
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
         * @var $dto DomainDto
         */
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getFriends())) {
            $this->replaceFriends(
                $fkTransformer->transformCollection(
                    $dto->getFriends()
                )
            );
        }
        if (!is_null($dto->getResidentialDevices())) {
            $this->replaceResidentialDevices(
                $fkTransformer->transformCollection(
                    $dto->getResidentialDevices()
                )
            );
        }
        if (!is_null($dto->getTerminals())) {
            $this->replaceTerminals(
                $fkTransformer->transformCollection(
                    $dto->getTerminals()
                )
            );
        }
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return DomainDto
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
     * Add friend
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend
     *
     * @return DomainTrait
     */
    public function addFriend(\Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend)
    {
        $this->friends->add($friend);

        return $this;
    }

    /**
     * Remove friend
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend
     */
    public function removeFriend(\Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend)
    {
        $this->friends->removeElement($friend);
    }

    /**
     * Replace friends
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface[] $friends
     * @return self
     */
    public function replaceFriends(Collection $friends)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($friends as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setDomain($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->friends as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->friends->set($key, $updatedEntities[$identity]);
            } else {
                $this->friends->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addFriend($entity);
        }

        return $this;
    }

    /**
     * Get friends
     *
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendInterface[]
     */
    public function getFriends(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->friends->matching($criteria)->toArray();
        }

        return $this->friends->toArray();
    }

    /**
     * Add residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice
     *
     * @return DomainTrait
     */
    public function addResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice)
    {
        $this->residentialDevices->add($residentialDevice);

        return $this;
    }

    /**
     * Remove residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice
     */
    public function removeResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice)
    {
        $this->residentialDevices->removeElement($residentialDevice);
    }

    /**
     * Replace residentialDevices
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface[] $residentialDevices
     * @return self
     */
    public function replaceResidentialDevices(Collection $residentialDevices)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($residentialDevices as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setDomain($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->residentialDevices as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->residentialDevices->set($key, $updatedEntities[$identity]);
            } else {
                $this->residentialDevices->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addResidentialDevice($entity);
        }

        return $this;
    }

    /**
     * Get residentialDevices
     *
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface[]
     */
    public function getResidentialDevices(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->residentialDevices->matching($criteria)->toArray();
        }

        return $this->residentialDevices->toArray();
    }

    /**
     * Add terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal
     *
     * @return DomainTrait
     */
    public function addTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal)
    {
        $this->terminals->add($terminal);

        return $this;
    }

    /**
     * Remove terminal
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal
     */
    public function removeTerminal(\Ivoz\Provider\Domain\Model\Terminal\TerminalInterface $terminal)
    {
        $this->terminals->removeElement($terminal);
    }

    /**
     * Replace terminals
     *
     * @param \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface[] $terminals
     * @return self
     */
    public function replaceTerminals(Collection $terminals)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($terminals as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setDomain($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->terminals as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->terminals->set($key, $updatedEntities[$identity]);
            } else {
                $this->terminals->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addTerminal($entity);
        }

        return $this;
    }

    /**
     * Get terminals
     *
     * @return \Ivoz\Provider\Domain\Model\Terminal\TerminalInterface[]
     */
    public function getTerminals(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->terminals->matching($criteria)->toArray();
        }

        return $this->terminals->toArray();
    }
}
