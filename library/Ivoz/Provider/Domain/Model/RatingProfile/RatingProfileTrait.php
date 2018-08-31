<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * RatingProfileTrait
 * @codeCoverageIgnore
 */
trait RatingProfileTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $tpRatingProfile;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->tpRatingProfile = new ArrayCollection();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto RatingProfileDto
         */
        $self = parent::fromDto($dto);
        if ($dto->getTpRatingProfile()) {
            $self->replaceTpRatingProfile($dto->getTpRatingProfile());
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
         * @var $dto RatingProfileDto
         */
        parent::updateFromDto($dto);
        if ($dto->getTpRatingProfile()) {
            $this->replaceTpRatingProfile($dto->getTpRatingProfile());
        }
        return $this;
    }

    /**
     * @param int $depth
     * @return RatingProfileDto
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
     * @return RatingProfileTrait
     */
    public function addTpRatingProfile(\Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile)
    {
        $this->tpRatingProfile->add($tpRatingProfile);

        return $this;
    }

    /**
     * Remove tpRatingProfile
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile
     */
    public function removeTpRatingProfile(\Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface $tpRatingProfile)
    {
        $this->tpRatingProfile->removeElement($tpRatingProfile);
    }

    /**
     * Replace tpRatingProfile
     *
     * @param \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface[] $tpRatingProfile
     * @return self
     */
    public function replaceTpRatingProfile(Collection $tpRatingProfile)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($tpRatingProfile as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setRatingProfile($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->tpRatingProfile as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->tpRatingProfile->set($key, $updatedEntities[$identity]);
            } else {
                $this->tpRatingProfile->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addTpRatingProfile($entity);
        }

        return $this;
    }

    /**
     * Get tpRatingProfile
     *
     * @return \Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface[]
     */
    public function getTpRatingProfile(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->tpRatingProfile->matching($criteria)->toArray();
        }

        return $this->tpRatingProfile->toArray();
    }


}

