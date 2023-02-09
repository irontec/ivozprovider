<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface;

/**
* @codeCoverageIgnore
*/
trait DdiProviderTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, DdiProviderRegistrationInterface> & Selectable<array-key, DdiProviderRegistrationInterface>
     * DdiProviderRegistrationInterface mappedBy ddiProvider
     */
    protected $ddiProviderRegistrations;

    /**
     * @var Collection<array-key, DdiProviderAddressInterface> & Selectable<array-key, DdiProviderAddressInterface>
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

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DdiProviderDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $ddiProviderRegistrations = $dto->getDdiProviderRegistrations();
        if (!is_null($ddiProviderRegistrations)) {

            /** @var Collection<array-key, DdiProviderRegistrationInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $ddiProviderRegistrations
            );
            $self->replaceDdiProviderRegistrations($replacement);
        }

        $ddiProviderAddresses = $dto->getDdiProviderAddresses();
        if (!is_null($ddiProviderAddresses)) {

            /** @var Collection<array-key, DdiProviderAddressInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $ddiProviderAddresses
            );
            $self->replaceDdiProviderAddresses($replacement);
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $ddiProviderRegistrations = $dto->getDdiProviderRegistrations();
        if (!is_null($ddiProviderRegistrations)) {

            /** @var Collection<array-key, DdiProviderRegistrationInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $ddiProviderRegistrations
            );
            $this->replaceDdiProviderRegistrations($replacement);
        }

        $ddiProviderAddresses = $dto->getDdiProviderAddresses();
        if (!is_null($ddiProviderAddresses)) {

            /** @var Collection<array-key, DdiProviderAddressInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $ddiProviderAddresses
            );
            $this->replaceDdiProviderAddresses($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DdiProviderDto
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

    /**
     * @param Collection<array-key, DdiProviderRegistrationInterface> $ddiProviderRegistrations
     */
    public function replaceDdiProviderRegistrations(Collection $ddiProviderRegistrations): DdiProviderInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ddiProviderRegistrations as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setDdiProvider($this);
        }

        foreach ($this->ddiProviderRegistrations as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->ddiProviderRegistrations->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->ddiProviderRegistrations->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->ddiProviderRegistrations->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addDdiProviderRegistration($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, DdiProviderRegistrationInterface>
     */
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

    /**
     * @param Collection<array-key, DdiProviderAddressInterface> $ddiProviderAddresses
     */
    public function replaceDdiProviderAddresses(Collection $ddiProviderAddresses): DdiProviderInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($ddiProviderAddresses as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setDdiProvider($this);
        }

        foreach ($this->ddiProviderAddresses as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->ddiProviderAddresses->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->ddiProviderAddresses->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->ddiProviderAddresses->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addDdiProviderAddress($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, DdiProviderAddressInterface>
     */
    public function getDdiProviderAddresses(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->ddiProviderAddresses->matching($criteria)->toArray();
        }

        return $this->ddiProviderAddresses->toArray();
    }
}
