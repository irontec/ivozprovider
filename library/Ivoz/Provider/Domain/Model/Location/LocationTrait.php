<?php

namespace Ivoz\Provider\Domain\Model\Location;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
 * LocationTrait
 * @codeCoverageIgnore
 */
trait LocationTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var ArrayCollection
     */
    protected $users;


    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->users = new ArrayCollection();
    }

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param LocationDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getUsers())) {
            $self->replaceUsers(
                $fkTransformer->transformCollection(
                    $dto->getUsers()
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
     * @param LocationDto $dto
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getUsers())) {
            $this->replaceUsers(
                $fkTransformer->transformCollection(
                    $dto->getUsers()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return LocationDto
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
     * Add user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return static
     */
    public function addUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user)
    {
        $this->users->add($user);

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     */
    public function removeUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Replace users
     *
     * @param ArrayCollection $users of Ivoz\Provider\Domain\Model\User\UserInterface
     * @return static
     */
    public function replaceUsers(ArrayCollection $users)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($users as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setLocation($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->users as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->users->set($key, $updatedEntities[$identity]);
            } else {
                $this->users->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addUser($entity);
        }

        return $this;
    }

    /**
     * Get users
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface[]
     */
    public function getUsers(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->users->matching($criteria)->toArray();
        }

        return $this->users->toArray();
    }
}
