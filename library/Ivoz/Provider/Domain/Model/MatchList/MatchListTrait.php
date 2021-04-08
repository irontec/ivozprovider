<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\MatchList;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait MatchListTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * MatchListPatternInterface mappedBy matchList
     */
    protected $patterns;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->patterns = new ArrayCollection();
    }

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param MatchListDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
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
     * @param MatchListDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
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
     * @return MatchListDto
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

    public function addPattern(MatchListPatternInterface $pattern): MatchListInterface
    {
        $this->patterns->add($pattern);

        return $this;
    }

    public function removePattern(MatchListPatternInterface $pattern): MatchListInterface
    {
        $this->patterns->removeElement($pattern);

        return $this;
    }

    public function replacePatterns(ArrayCollection $patterns): MatchListInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($patterns as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setMatchList($this);
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

    public function getPatterns(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->patterns->matching($criteria)->toArray();
        }

        return $this->patterns->toArray();
    }
}
