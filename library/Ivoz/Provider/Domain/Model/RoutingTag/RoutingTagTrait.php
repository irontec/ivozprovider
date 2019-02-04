<?php

namespace Ivoz\Provider\Domain\Model\RoutingTag;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * RoutingTagTrait
 * @codeCoverageIgnore
 */
trait RoutingTagTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $outgoingRoutings;

    /**
     * @var Collection
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

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto RoutingTagDto
         */
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
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto RoutingTagDto
         */
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
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return RoutingTagDto
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
     * Add outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return RoutingTagTrait
     */
    public function addOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting)
    {
        $this->outgoingRoutings->add($outgoingRouting);

        return $this;
    }

    /**
     * Remove outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     */
    public function removeOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting)
    {
        $this->outgoingRoutings->removeElement($outgoingRouting);
    }

    /**
     * Replace outgoingRoutings
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[] $outgoingRoutings
     * @return self
     */
    public function replaceOutgoingRoutings(Collection $outgoingRoutings)
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

    /**
     * Get outgoingRoutings
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface[]
     */
    public function getOutgoingRoutings(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->outgoingRoutings->matching($criteria)->toArray();
        }

        return $this->outgoingRoutings->toArray();
    }

    /**
     * Add relCompany
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface $relCompany
     *
     * @return RoutingTagTrait
     */
    public function addRelCompany(\Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface $relCompany)
    {
        $this->relCompanies->add($relCompany);

        return $this;
    }

    /**
     * Remove relCompany
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface $relCompany
     */
    public function removeRelCompany(\Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface $relCompany)
    {
        $this->relCompanies->removeElement($relCompany);
    }

    /**
     * Replace relCompanies
     *
     * @param \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface[] $relCompanies
     * @return self
     */
    public function replaceRelCompanies(Collection $relCompanies)
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

    /**
     * Get relCompanies
     *
     * @return \Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface[]
     */
    public function getRelCompanies(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relCompanies->matching($criteria)->toArray();
        }

        return $this->relCompanies->toArray();
    }
}
