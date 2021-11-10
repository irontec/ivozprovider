<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\RoutingTag;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;

/**
* @codeCoverageIgnore
*/
trait RoutingTagTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * OutgoingRoutingInterface mappedBy routingTag
     */
    protected $outgoingRoutings;

    /**
     * @var ArrayCollection
     * CompanyRelRoutingTagInterface mappedBy routingTag
     */
    protected $relCompanies;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->outgoingRoutings = new ArrayCollection();
        $this->relCompanies = new ArrayCollection();
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
        if (!is_null($dto->getOutgoingRoutings())) {
            $self->replaceOutgoingRoutings(
                $fkTransformer->transformCollection(
                    $dto->getOutgoingRoutings()
                )
            );
        }

        if (!is_null($dto->getRelCompanies())) {
            $self->replaceRelCompanies(
                $fkTransformer->transformCollection(
                    $dto->getRelCompanies()
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
        if (!is_null($dto->getOutgoingRoutings())) {
            $this->replaceOutgoingRoutings(
                $fkTransformer->transformCollection(
                    $dto->getOutgoingRoutings()
                )
            );
        }

        if (!is_null($dto->getRelCompanies())) {
            $this->replaceRelCompanies(
                $fkTransformer->transformCollection(
                    $dto->getRelCompanies()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RoutingTagDto
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

    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingTagInterface
    {
        $this->outgoingRoutings->add($outgoingRouting);

        return $this;
    }

    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingTagInterface
    {
        $this->outgoingRoutings->removeElement($outgoingRouting);

        return $this;
    }

    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): RoutingTagInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($outgoingRoutings as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRoutingTag($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->outgoingRoutings as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->outgoingRoutings->set($key, $updatedEntities[$identity]);
            } else {
                $this->outgoingRoutings->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addOutgoingRouting($entity);
        }

        return $this;
    }

    public function getOutgoingRoutings(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->outgoingRoutings->matching($criteria)->toArray();
        }

        return $this->outgoingRoutings->toArray();
    }

    public function addRelCompany(CompanyRelRoutingTagInterface $relCompany): RoutingTagInterface
    {
        $this->relCompanies->add($relCompany);

        return $this;
    }

    public function removeRelCompany(CompanyRelRoutingTagInterface $relCompany): RoutingTagInterface
    {
        $this->relCompanies->removeElement($relCompany);

        return $this;
    }

    public function replaceRelCompanies(ArrayCollection $relCompanies): RoutingTagInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relCompanies as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRoutingTag($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relCompanies as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relCompanies->set($key, $updatedEntities[$identity]);
            } else {
                $this->relCompanies->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelCompany($entity);
        }

        return $this;
    }

    public function getRelCompanies(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relCompanies->matching($criteria)->toArray();
        }

        return $this->relCompanies->toArray();
    }
}
