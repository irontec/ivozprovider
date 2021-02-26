<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait DestinationRateGroupTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * DestinationRateInterface mappedBy destinationRateGroup
     */
    protected $destinationRates;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->destinationRates = new ArrayCollection();
    }

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DestinationRateGroupDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getDestinationRates())) {
            $self->replaceDestinationRates(
                $fkTransformer->transformCollection(
                    $dto->getDestinationRates()
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
     * @param DestinationRateGroupDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getDestinationRates())) {
            $this->replaceDestinationRates(
                $fkTransformer->transformCollection(
                    $dto->getDestinationRates()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return DestinationRateGroupDto
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

    public function addDestinationRate(DestinationRateInterface $destinationRate): DestinationRateGroupInterface
    {
        $this->destinationRates->add($destinationRate);

        return $this;
    }

    public function removeDestinationRate(DestinationRateInterface $destinationRate): DestinationRateGroupInterface
    {
        $this->destinationRates->removeElement($destinationRate);

        return $this;
    }

    public function replaceDestinationRates(ArrayCollection $destinationRates): DestinationRateGroupInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($destinationRates as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setDestinationRateGroup($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->destinationRates as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->destinationRates->set($key, $updatedEntities[$identity]);
            } else {
                $this->destinationRates->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addDestinationRate($entity);
        }

        return $this;
    }

    public function getDestinationRates(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->destinationRates->matching($criteria)->toArray();
        }

        return $this->destinationRates->toArray();
    }

}
