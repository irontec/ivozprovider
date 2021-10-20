<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait CallAclTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * CallAclRelMatchListInterface mappedBy callAcl
     * orphanRemoval
     */
    protected $relMatchLists;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->relMatchLists = new ArrayCollection();
    }

    abstract protected function sanitizeValues();

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
        if (!is_null($dto->getRelMatchLists())) {
            $self->replaceRelMatchLists(
                $fkTransformer->transformCollection(
                    $dto->getRelMatchLists()
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
        if (!is_null($dto->getRelMatchLists())) {
            $this->replaceRelMatchLists(
                $fkTransformer->transformCollection(
                    $dto->getRelMatchLists()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     */
    public function toDto($depth = 0): CallAclDto
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

    public function addRelMatchList(CallAclRelMatchListInterface $relMatchList): CallAclInterface
    {
        $this->relMatchLists->add($relMatchList);

        return $this;
    }

    public function removeRelMatchList(CallAclRelMatchListInterface $relMatchList): CallAclInterface
    {
        $this->relMatchLists->removeElement($relMatchList);

        return $this;
    }

    public function replaceRelMatchLists(ArrayCollection $relMatchLists): CallAclInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relMatchLists as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCallAcl($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relMatchLists as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relMatchLists->set($key, $updatedEntities[$identity]);
            } else {
                $this->relMatchLists->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelMatchList($entity);
        }

        return $this;
    }

    public function getRelMatchLists(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relMatchLists->matching($criteria)->toArray();
        }

        return $this->relMatchLists->toArray();
    }
}
