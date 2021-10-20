<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Domain;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;

/**
* @codeCoverageIgnore
*/
trait DomainTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * FriendInterface mappedBy domain
     */
    protected $friends;

    /**
     * @var ArrayCollection
     * ResidentialDeviceInterface mappedBy domain
     */
    protected $residentialDevices;

    /**
     * @var ArrayCollection
     * TerminalInterface mappedBy domain
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

    abstract protected function sanitizeValues();

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
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): DomainDto
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

    public function addFriend(FriendInterface $friend): DomainInterface
    {
        $this->friends->add($friend);

        return $this;
    }

    public function removeFriend(FriendInterface $friend): DomainInterface
    {
        $this->friends->removeElement($friend);

        return $this;
    }

    public function replaceFriends(ArrayCollection $friends): DomainInterface
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

    public function getFriends(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->friends->matching($criteria)->toArray();
        }

        return $this->friends->toArray();
    }

    public function addResidentialDevice(ResidentialDeviceInterface $residentialDevice): DomainInterface
    {
        $this->residentialDevices->add($residentialDevice);

        return $this;
    }

    public function removeResidentialDevice(ResidentialDeviceInterface $residentialDevice): DomainInterface
    {
        $this->residentialDevices->removeElement($residentialDevice);

        return $this;
    }

    public function replaceResidentialDevices(ArrayCollection $residentialDevices): DomainInterface
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

    public function getResidentialDevices(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->residentialDevices->matching($criteria)->toArray();
        }

        return $this->residentialDevices->toArray();
    }

    public function addTerminal(TerminalInterface $terminal): DomainInterface
    {
        $this->terminals->add($terminal);

        return $this;
    }

    public function removeTerminal(TerminalInterface $terminal): DomainInterface
    {
        $this->terminals->removeElement($terminal);

        return $this;
    }

    public function replaceTerminals(ArrayCollection $terminals): DomainInterface
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

    public function getTerminals(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->terminals->matching($criteria)->toArray();
        }

        return $this->terminals->toArray();
    }
}
