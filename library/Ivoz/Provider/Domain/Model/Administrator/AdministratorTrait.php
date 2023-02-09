<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Administrator;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait AdministratorTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, AdministratorRelPublicEntityInterface> & Selectable<array-key, AdministratorRelPublicEntityInterface>
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
     * @param AdministratorDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $relPublicEntities = $dto->getRelPublicEntities();
        if (!is_null($relPublicEntities)) {

            /** @var Collection<array-key, AdministratorRelPublicEntityInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relPublicEntities
            );
            $self->replaceRelPublicEntities($replacement);
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $relPublicEntities = $dto->getRelPublicEntities();
        if (!is_null($relPublicEntities)) {

            /** @var Collection<array-key, AdministratorRelPublicEntityInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relPublicEntities
            );
            $this->replaceRelPublicEntities($replacement);
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

    /**
     * @return array<string, mixed>
     */
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

    /**
     * @param Collection<array-key, AdministratorRelPublicEntityInterface> $relPublicEntities
     */
    public function replaceRelPublicEntities(Collection $relPublicEntities): AdministratorInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relPublicEntities as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setAdministrator($this);
        }

        foreach ($this->relPublicEntities as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->relPublicEntities->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->relPublicEntities->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->relPublicEntities->remove($key);
            }
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelPublicEntity($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, AdministratorRelPublicEntityInterface>
     */
    public function getRelPublicEntities(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relPublicEntities->matching($criteria)->toArray();
        }

        return $this->relPublicEntities->toArray();
    }
}
