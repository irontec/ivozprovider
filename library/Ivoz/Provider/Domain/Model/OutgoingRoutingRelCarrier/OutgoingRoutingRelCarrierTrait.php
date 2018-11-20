<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * OutgoingRoutingRelCarrierTrait
 * @codeCoverageIgnore
 */
trait OutgoingRoutingRelCarrierTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
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

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto OutgoingRoutingRelCarrierDto
         */
        $self = parent::fromDto($dto);
        if ($dto->getTpRatingProfiles()) {
            $self->replaceTpRatingProfiles($dto->getTpRatingProfiles());
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
         * @var $dto OutgoingRoutingRelCarrierDto
         */
        parent::updateFromDto($dto);
        if ($dto->getTpRatingProfiles()) {
            $this->replaceTpRatingProfiles($dto->getTpRatingProfiles());
        }
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return OutgoingRoutingRelCarrierDto
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
     * Add tpRatingProfile
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile
     *
     * @return OutgoingRoutingRelCarrierTrait
     */
    public function addTpRatingProfile(\Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile)
    {
        $this->tpRatingProfiles->add($tpRatingProfile);

        return $this;
    }

    /**
     * Remove tpRatingProfile
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile
     */
    public function removeTpRatingProfile(\Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile)
    {
        $this->tpRatingProfiles->removeElement($tpRatingProfile);
    }

    /**
     * Replace tpRatingProfiles
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface[] $tpRatingProfiles
     * @return self
     */
    public function replaceTpRatingProfiles(Collection $tpRatingProfiles)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($tpRatingProfiles as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setOutgoingRoutingRelCarrier($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->tpRatingProfiles as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->tpRatingProfiles->set($key, $updatedEntities[$identity]);
            } else {
                $this->tpRatingProfiles->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addTpRatingProfile($entity);
        }

        return $this;
    }

    /**
     * Get tpRatingProfiles
     *
     * @return \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface[]
     */
    public function getTpRatingProfiles(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->tpRatingProfiles->matching($criteria)->toArray();
        }

        return $this->tpRatingProfiles->toArray();
    }
}
