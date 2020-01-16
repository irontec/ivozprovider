<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * AdministratorTrait
 * @codeCoverageIgnore
 */
trait AdministratorTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $relPublicEntities;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->relPublicEntities = new ArrayCollection();
    }

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param AdministratorDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getRelPublicEntities())) {
            $self->replaceRelPublicEntities(
                $fkTransformer->transformCollection(
                    $dto->getRelPublicEntities()
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
     * @param AdministratorDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getRelPublicEntities())) {
            $this->replaceRelPublicEntities(
                $fkTransformer->transformCollection(
                    $dto->getRelPublicEntities()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return AdministratorDto
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
     * Add relPublicEntity
     *
     * @param \Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface $relPublicEntity
     *
     * @return static
     */
    public function addRelPublicEntity(\Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface $relPublicEntity)
    {
        $this->relPublicEntities->add($relPublicEntity);

        return $this;
    }

    /**
     * Remove relPublicEntity
     *
     * @param \Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface $relPublicEntity
     */
    public function removeRelPublicEntity(\Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface $relPublicEntity)
    {
        $this->relPublicEntities->removeElement($relPublicEntity);
    }

    /**
     * Replace relPublicEntities
     *
     * @param ArrayCollection $relPublicEntities of Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface
     * @return static
     */
    public function replaceRelPublicEntities(ArrayCollection $relPublicEntities)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relPublicEntities as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setAdministrator($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relPublicEntities as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relPublicEntities->set($key, $updatedEntities[$identity]);
            } else {
                $this->relPublicEntities->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelPublicEntity($entity);
        }

        return $this;
    }

    /**
     * Get relPublicEntities
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface[]
     */
    public function getRelPublicEntities(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relPublicEntities->matching($criteria)->toArray();
        }

        return $this->relPublicEntities->toArray();
    }
}
