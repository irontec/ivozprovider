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
    protected $retailAccounts;

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
        $this->retailAccounts = new ArrayCollection();
        $this->terminals = new ArrayCollection();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto DomainDto
         */
        $self = parent::fromDto($dto);
        if ($dto->getFriends()) {
            $self->replaceFriends($dto->getFriends());
        }

        if ($dto->getRetailAccounts()) {
            $self->replaceRetailAccounts($dto->getRetailAccounts());
        }

        if ($dto->getTerminals()) {
            $self->replaceTerminals($dto->getTerminals());
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
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto DomainDto
         */
        parent::updateFromDto($dto);
        if ($dto->getFriends()) {
            $this->replaceFriends($dto->getFriends());
        }
        if ($dto->getRetailAccounts()) {
            $this->replaceRetailAccounts($dto->getRetailAccounts());
        }
        if ($dto->getTerminals()) {
            $this->replaceTerminals($dto->getTerminals());
        }
        return $this;
    }

    /**
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
     * Add retailAccount
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount
     *
     * @return DomainTrait
     */
    public function addRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount)
    {
        $this->retailAccounts->add($retailAccount);

        return $this;
    }

    /**
     * Remove retailAccount
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount
     */
    public function removeRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount)
    {
        $this->retailAccounts->removeElement($retailAccount);
    }

    /**
     * Replace retailAccounts
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface[] $retailAccounts
     * @return self
     */
    public function replaceRetailAccounts(Collection $retailAccounts)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($retailAccounts as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setDomain($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->retailAccounts as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->retailAccounts->set($key, $updatedEntities[$identity]);
            } else {
                $this->retailAccounts->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRetailAccount($entity);
        }

        return $this;
    }

    /**
     * Get retailAccounts
     *
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface[]
     */
    public function getRetailAccounts(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->retailAccounts->matching($criteria)->toArray();
        }

        return $this->retailAccounts->toArray();
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

