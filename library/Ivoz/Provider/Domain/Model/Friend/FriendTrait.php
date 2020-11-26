<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Friend;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternInterface;

/**
* @codeCoverageIgnore
*/
trait FriendTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * PsEndpointInterface mappedBy friend
     */
    protected $psEndpoints;

    /**
     * @var ArrayCollection
     * FriendsPatternInterface mappedBy friend
     */
    protected $patterns;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->psEndpoints = new ArrayCollection();
        $this->patterns = new ArrayCollection();
    }

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FriendDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getPsEndpoints())) {
            $self->replacePsEndpoints(
                $fkTransformer->transformCollection(
                    $dto->getPsEndpoints()
                )
            );
        }

        if (!is_null($dto->getPatterns())) {
            $self->replacePatterns(
                $fkTransformer->transformCollection(
                    $dto->getPatterns()
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
     * @param FriendDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getPsEndpoints())) {
            $this->replacePsEndpoints(
                $fkTransformer->transformCollection(
                    $dto->getPsEndpoints()
                )
            );
        }

        if (!is_null($dto->getPatterns())) {
            $this->replacePatterns(
                $fkTransformer->transformCollection(
                    $dto->getPatterns()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return FriendDto
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
     * Add psEndpoint
     *
     * @param PsEndpointInterface $psEndpoint
     *
     * @return static
     */
    public function addPsEndpoint(PsEndpointInterface $psEndpoint): FriendInterface
    {
        $this->psEndpoints->add($psEndpoint);

        return $this;
    }

    /**
     * Remove psEndpoint
     *
     * @param PsEndpointInterface $psEndpoint
     *
     * @return static
     */
    public function removePsEndpoint(PsEndpointInterface $psEndpoint): FriendInterface
    {
        $this->psEndpoints->removeElement($psEndpoint);

        return $this;
    }

    /**
     * Replace psEndpoints
     *
     * @param ArrayCollection $psEndpoints of PsEndpointInterface
     *
     * @return static
     */
    public function replacePsEndpoints(ArrayCollection $psEndpoints): FriendInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($psEndpoints as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setFriend($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->psEndpoints as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->psEndpoints->set($key, $updatedEntities[$identity]);
            } else {
                $this->psEndpoints->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addPsEndpoint($entity);
        }

        return $this;
    }

    /**
     * Get psEndpoints
     * @param Criteria | null $criteria
     * @return PsEndpointInterface[]
     */
    public function getPsEndpoints(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->psEndpoints->matching($criteria)->toArray();
        }

        return $this->psEndpoints->toArray();
    }

    /**
     * Add pattern
     *
     * @param FriendsPatternInterface $pattern
     *
     * @return static
     */
    public function addPattern(FriendsPatternInterface $pattern): FriendInterface
    {
        $this->patterns->add($pattern);

        return $this;
    }

    /**
     * Remove pattern
     *
     * @param FriendsPatternInterface $pattern
     *
     * @return static
     */
    public function removePattern(FriendsPatternInterface $pattern): FriendInterface
    {
        $this->patterns->removeElement($pattern);

        return $this;
    }

    /**
     * Replace patterns
     *
     * @param ArrayCollection $patterns of FriendsPatternInterface
     *
     * @return static
     */
    public function replacePatterns(ArrayCollection $patterns): FriendInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($patterns as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setFriend($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->patterns as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->patterns->set($key, $updatedEntities[$identity]);
            } else {
                $this->patterns->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addPattern($entity);
        }

        return $this;
    }

    /**
     * Get patterns
     * @param Criteria | null $criteria
     * @return FriendsPatternInterface[]
     */
    public function getPatterns(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->patterns->matching($criteria)->toArray();
        }

        return $this->patterns->toArray();
    }

}
