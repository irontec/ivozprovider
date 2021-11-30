<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\RoutingTag;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;

/**
* @codeCoverageIgnore
*/
trait RoutingTagTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, OutgoingRoutingInterface> & Selectable<array-key, OutgoingRoutingInterface>
     * OutgoingRoutingInterface mappedBy routingTag
     */
    protected $outgoingRoutings;

    /**
     * @var Collection<array-key, CompanyRelRoutingTagInterface> & Selectable<array-key, CompanyRelRoutingTagInterface>
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
     * @param RoutingTagDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $outgoingRoutings = $dto->getOutgoingRoutings();
        if (!is_null($outgoingRoutings)) {

            /** @var Collection<array-key, OutgoingRoutingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $outgoingRoutings
            );
            $self->replaceOutgoingRoutings($replacement);
        }

        $relCompanies = $dto->getRelCompanies();
        if (!is_null($relCompanies)) {

            /** @var Collection<array-key, CompanyRelRoutingTagInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relCompanies
            );
            $self->replaceRelCompanies($replacement);
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
     * @param RoutingTagDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $outgoingRoutings = $dto->getOutgoingRoutings();
        if (!is_null($outgoingRoutings)) {

            /** @var Collection<array-key, OutgoingRoutingInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $outgoingRoutings
            );
            $this->replaceOutgoingRoutings($replacement);
        }

        $relCompanies = $dto->getRelCompanies();
        if (!is_null($relCompanies)) {

            /** @var Collection<array-key, CompanyRelRoutingTagInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relCompanies
            );
            $this->replaceRelCompanies($replacement);
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

    /**
     * @param Collection<array-key, OutgoingRoutingInterface> $outgoingRoutings
     */
    public function replaceOutgoingRoutings(Collection $outgoingRoutings): RoutingTagInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($outgoingRoutings as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRoutingTag($this);
        }

        foreach ($this->outgoingRoutings as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->outgoingRoutings->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->outgoingRoutings->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->outgoingRoutings->remove($key);
            }
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

    /**
     * @param Collection<array-key, CompanyRelRoutingTagInterface> $relCompanies
     */
    public function replaceRelCompanies(Collection $relCompanies): RoutingTagInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relCompanies as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRoutingTag($this);
        }

        foreach ($this->relCompanies as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->relCompanies->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->relCompanies->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->relCompanies->remove($key);
            }
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
