<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait OutgoingRoutingRelCarrierTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, TpRatingProfileInterface> & Selectable<array-key, TpRatingProfileInterface>
     * TpRatingProfileInterface mappedBy outgoingRoutingRelCarrier
     */
    protected $tpRatingProfiles;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->tpRatingProfiles = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param OutgoingRoutingRelCarrierDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $tpRatingProfiles = $dto->getTpRatingProfiles();
        if (!is_null($tpRatingProfiles)) {

            /** @var Collection<array-key, TpRatingProfileInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $tpRatingProfiles
            );
            $self->replaceTpRatingProfiles($replacement);
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
     * @param OutgoingRoutingRelCarrierDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $tpRatingProfiles = $dto->getTpRatingProfiles();
        if (!is_null($tpRatingProfiles)) {

            /** @var Collection<array-key, TpRatingProfileInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $tpRatingProfiles
            );
            $this->replaceTpRatingProfiles($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): OutgoingRoutingRelCarrierDto
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

    public function addTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): OutgoingRoutingRelCarrierInterface
    {
        $this->tpRatingProfiles->add($tpRatingProfile);

        return $this;
    }

    public function removeTpRatingProfile(TpRatingProfileInterface $tpRatingProfile): OutgoingRoutingRelCarrierInterface
    {
        $this->tpRatingProfiles->removeElement($tpRatingProfile);

        return $this;
    }

    /**
     * @param Collection<array-key, TpRatingProfileInterface> $tpRatingProfiles
     */
    public function replaceTpRatingProfiles(Collection $tpRatingProfiles): OutgoingRoutingRelCarrierInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($tpRatingProfiles as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setOutgoingRoutingRelCarrier($this);
        }

        foreach ($this->tpRatingProfiles as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->tpRatingProfiles->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->tpRatingProfiles->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->tpRatingProfiles->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addTpRatingProfile($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, TpRatingProfileInterface>
     */
    public function getTpRatingProfiles(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->tpRatingProfiles->matching($criteria)->toArray();
        }

        return $this->tpRatingProfiles->toArray();
    }
}
