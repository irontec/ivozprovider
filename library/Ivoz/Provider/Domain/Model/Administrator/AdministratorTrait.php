<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait AdministratorTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * AdministratorRelPublicEntityInterface mappedBy administrator
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
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
     */
    public function toDto(int $depth = 0): AdministratorDto
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

    public function addRelPublicEntity(AdministratorRelPublicEntityInterface $relPublicEntity): AdministratorInterface
    {
        $this->relPublicEntities->add($relPublicEntity);

        return $this;
    }

    public function removeRelPublicEntity(AdministratorRelPublicEntityInterface $relPublicEntity): AdministratorInterface
    {
        $this->relPublicEntities->removeElement($relPublicEntity);

        return $this;
    }

    public function replaceRelPublicEntities(ArrayCollection $relPublicEntities): AdministratorInterface
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

    public function getRelPublicEntities(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relPublicEntities->matching($criteria)->toArray();
        }

        return $this->relPublicEntities->toArray();
    }
}
