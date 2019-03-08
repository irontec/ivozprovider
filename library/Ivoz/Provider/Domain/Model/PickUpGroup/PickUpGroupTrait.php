<?php

namespace Ivoz\Provider\Domain\Model\PickUpGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * PickUpGroupTrait
 * @codeCoverageIgnore
 */
trait PickUpGroupTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $relUsers;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->relUsers = new ArrayCollection();
    }

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param PickUpGroupDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getRelUsers())) {
            $self->replaceRelUsers(
                $fkTransformer->transformCollection(
                    $dto->getRelUsers()
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
     * @param PickUpGroupDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getRelUsers())) {
            $this->replaceRelUsers(
                $fkTransformer->transformCollection(
                    $dto->getRelUsers()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return PickUpGroupDto
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
     * Add relUser
     *
     * @param \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $relUser
     *
     * @return static
     */
    public function addRelUser(\Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $relUser)
    {
        $this->relUsers->add($relUser);

        return $this;
    }

    /**
     * Remove relUser
     *
     * @param \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $relUser
     */
    public function removeRelUser(\Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface $relUser)
    {
        $this->relUsers->removeElement($relUser);
    }

    /**
     * Replace relUsers
     *
     * @param ArrayCollection $relUsers of Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface
     * @return static
     */
    public function replaceRelUsers(ArrayCollection $relUsers)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relUsers as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setPickUpGroup($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relUsers as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relUsers->set($key, $updatedEntities[$identity]);
            } else {
                $this->relUsers->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelUser($entity);
        }

        return $this;
    }

    /**
     * Get relUsers
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface[]
     */
    public function getRelUsers(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relUsers->matching($criteria)->toArray();
        }

        return $this->relUsers->toArray();
    }
}
