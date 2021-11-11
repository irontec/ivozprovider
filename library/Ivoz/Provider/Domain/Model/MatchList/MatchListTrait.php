<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\MatchList;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait MatchListTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, MatchListPatternInterface> & Selectable<array-key, MatchListPatternInterface>
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

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param MatchListDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $patterns = $dto->getPatterns();
        if (!is_null($patterns)) {

            /** @var Collection<array-key, MatchListPatternInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $patterns
            );
            $self->replacePatterns($replacement);
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $patterns = $dto->getPatterns();
        if (!is_null($patterns)) {

            /** @var Collection<array-key, MatchListPatternInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $patterns
            );
            $this->replacePatterns($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): MatchListDto
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

    /**
     * @param Collection<array-key, MatchListPatternInterface> $patterns
     */
    public function replacePatterns(Collection $patterns): MatchListInterface
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($patterns as $entity) {
            /** @var string|int $index */
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setMatchList($this);
        }

        foreach ($this->patterns as $key => $entity) {
            $identity = $entity->getId();
            if (!$identity) {
                $this->patterns->remove($key);
                continue;
            }

            if (array_key_exists($identity, $updatedEntities)) {
                $this->patterns->set($key, $updatedEntities[$identity]);
                unset($updatedEntities[$identity]);
            } else {
                $this->patterns->remove($key);
            }
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
