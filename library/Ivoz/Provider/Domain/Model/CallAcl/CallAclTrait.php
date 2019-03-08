<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * CallAclTrait
 * @codeCoverageIgnore
 */
trait CallAclTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var ArrayCollection
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
     * @param CallAclDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param CallAclDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @return CallAclDto
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
     * Add relMatchList
     *
     * @param \Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface $relMatchList
     *
     * @return static
     */
    public function addRelMatchList(\Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface $relMatchList)
    {
        $this->relMatchLists->add($relMatchList);

        return $this;
    }

    /**
     * Remove relMatchList
     *
     * @param \Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface $relMatchList
     */
    public function removeRelMatchList(\Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface $relMatchList)
    {
        $this->relMatchLists->removeElement($relMatchList);
    }

    /**
     * Replace relMatchLists
     *
     * @param ArrayCollection $relMatchLists of Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface
     * @return static
     */
    public function replaceRelMatchLists(ArrayCollection $relMatchLists)
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

    /**
     * Get relMatchLists
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface[]
     */
    public function getRelMatchLists(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relMatchLists->matching($criteria)->toArray();
        }

        return $this->relMatchLists->toArray();
    }
}
