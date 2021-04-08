<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface;

/**
* @codeCoverageIgnore
*/
trait DdiProviderTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * DdiProviderRegistrationInterface mappedBy ddiProvider
     */
    protected $ddiProviderRegistrations;

    /**
     * @var ArrayCollection
     * DdiProviderAddressInterface mappedBy ddiProvider
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
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
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
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
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

    public function addDdiProviderRegistration(DdiProviderRegistrationInterface $ddiProviderRegistration): DdiProviderInterface
    {
        $this->ddiProviderRegistrations->add($ddiProviderRegistration);

        return $this;
    }

    public function removeDdiProviderRegistration(DdiProviderRegistrationInterface $ddiProviderRegistration): DdiProviderInterface
    {
        $this->ddiProviderRegistrations->removeElement($ddiProviderRegistration);

        return $this;
    }

    public function replaceDdiProviderRegistrations(ArrayCollection $ddiProviderRegistrations): DdiProviderInterface
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

    public function getDdiProviderRegistrations(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->ddiProviderRegistrations->matching($criteria)->toArray();
        }

        return $this->ddiProviderRegistrations->toArray();
    }

    public function addDdiProviderAddress(DdiProviderAddressInterface $ddiProviderAddress): DdiProviderInterface
    {
        $this->ddiProviderAddresses->add($ddiProviderAddress);

        return $this;
    }

    public function removeDdiProviderAddress(DdiProviderAddressInterface $ddiProviderAddress): DdiProviderInterface
    {
        $this->ddiProviderAddresses->removeElement($ddiProviderAddress);

        return $this;
    }

    public function replaceDdiProviderAddresses(ArrayCollection $ddiProviderAddresses): DdiProviderInterface
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

    public function getDdiProviderAddresses(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->ddiProviderAddresses->matching($criteria)->toArray();
        }

        return $this->ddiProviderAddresses->toArray();
    }
}
