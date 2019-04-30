<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @var ArrayCollection
     */
    protected $ddiProviderRegistrations;

    /**
     * @var ArrayCollection
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

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DdiProviderDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getDdiProviderRegistrations())) {
            $self->replaceDdiProviderRegistrations(
                $fkTransformer->transformCollection(
                    $dto->getDdiProviderRegistrations()
                )
            );
        }

        if (!is_null($dto->getDdiProviderAddresses())) {
            $self->replaceDdiProviderAddresses(
                $fkTransformer->transformCollection(
                    $dto->getDdiProviderAddresses()
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
     * @param DdiProviderDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getDdiProviderRegistrations())) {
            $this->replaceDdiProviderRegistrations(
                $fkTransformer->transformCollection(
                    $dto->getDdiProviderRegistrations()
                )
            );
        }
        if (!is_null($dto->getDdiProviderAddresses())) {
            $this->replaceDdiProviderAddresses(
                $fkTransformer->transformCollection(
                    $dto->getDdiProviderAddresses()
                )
            );
        }
        $this->sanitizeValues();

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
     * @return static
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
     * @param ArrayCollection $ddiProviderRegistrations of Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface
     * @return static
     */
    public function replaceDdiProviderRegistrations(ArrayCollection $ddiProviderRegistrations)
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
     * @param Criteria | null $criteria
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
     * @return static
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
     * @param ArrayCollection $ddiProviderAddresses of Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface
     * @return static
     */
    public function replaceDdiProviderAddresses(ArrayCollection $ddiProviderAddresses)
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
     * @param Criteria | null $criteria
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
