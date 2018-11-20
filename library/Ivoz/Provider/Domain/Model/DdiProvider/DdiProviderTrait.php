<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * DdiProviderTrait
 * @codeCoverageIgnore
 */
trait DdiProviderTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $ddiProviderRegistrations;

    /**
     * @var Collection
     */
    protected $ddiProviderAddresses;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->ddiProviderRegistrations = new ArrayCollection();
        $this->ddiProviderAddresses = new ArrayCollection();
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto DdiProviderDto
         */
        $self = parent::fromDto($dto);
        if ($dto->getDdiProviderRegistrations()) {
            $self->replaceDdiProviderRegistrations($dto->getDdiProviderRegistrations());
        }

        if ($dto->getDdiProviderAddresses()) {
            $self->replaceDdiProviderAddresses($dto->getDdiProviderAddresses());
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
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto DdiProviderDto
         */
        parent::updateFromDto($dto);
        if ($dto->getDdiProviderRegistrations()) {
            $this->replaceDdiProviderRegistrations($dto->getDdiProviderRegistrations());
        }
        if ($dto->getDdiProviderAddresses()) {
            $this->replaceDdiProviderAddresses($dto->getDdiProviderAddresses());
        }
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return DdiProviderDto
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
     * Add ddiProviderRegistration
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface $ddiProviderRegistration
     *
     * @return DdiProviderTrait
     */
    public function addDdiProviderRegistration(\Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface $ddiProviderRegistration)
    {
        $this->ddiProviderRegistrations->add($ddiProviderRegistration);

        return $this;
    }

    /**
     * Remove ddiProviderRegistration
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface $ddiProviderRegistration
     */
    public function removeDdiProviderRegistration(\Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface $ddiProviderRegistration)
    {
        $this->ddiProviderRegistrations->removeElement($ddiProviderRegistration);
    }

    /**
     * Replace ddiProviderRegistrations
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface[] $ddiProviderRegistrations
     * @return self
     */
    public function replaceDdiProviderRegistrations(Collection $ddiProviderRegistrations)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ddiProviderRegistrations as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setDdiProvider($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->ddiProviderRegistrations as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->ddiProviderRegistrations->set($key, $updatedEntities[$identity]);
            } else {
                $this->ddiProviderRegistrations->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addDdiProviderRegistration($entity);
        }

        return $this;
    }

    /**
     * Get ddiProviderRegistrations
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface[]
     */
    public function getDdiProviderRegistrations(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->ddiProviderRegistrations->matching($criteria)->toArray();
        }

        return $this->ddiProviderRegistrations->toArray();
    }

    /**
     * Add ddiProviderAddress
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface $ddiProviderAddress
     *
     * @return DdiProviderTrait
     */
    public function addDdiProviderAddress(\Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface $ddiProviderAddress)
    {
        $this->ddiProviderAddresses->add($ddiProviderAddress);

        return $this;
    }

    /**
     * Remove ddiProviderAddress
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface $ddiProviderAddress
     */
    public function removeDdiProviderAddress(\Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface $ddiProviderAddress)
    {
        $this->ddiProviderAddresses->removeElement($ddiProviderAddress);
    }

    /**
     * Replace ddiProviderAddresses
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface[] $ddiProviderAddresses
     * @return self
     */
    public function replaceDdiProviderAddresses(Collection $ddiProviderAddresses)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ddiProviderAddresses as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setDdiProvider($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->ddiProviderAddresses as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->ddiProviderAddresses->set($key, $updatedEntities[$identity]);
            } else {
                $this->ddiProviderAddresses->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addDdiProviderAddress($entity);
        }

        return $this;
    }

    /**
     * Get ddiProviderAddresses
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface[]
     */
    public function getDdiProviderAddresses(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->ddiProviderAddresses->matching($criteria)->toArray();
        }

        return $this->ddiProviderAddresses->toArray();
    }
}
