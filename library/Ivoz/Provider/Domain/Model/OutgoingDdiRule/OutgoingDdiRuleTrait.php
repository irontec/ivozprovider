<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait OutgoingDdiRuleTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, OutgoingDdiRulesPatternInterface> & Selectable<array-key, OutgoingDdiRulesPatternInterface>
     * OutgoingDdiRulesPatternInterface mappedBy outgoingDdiRule
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
     * @param OutgoingDdiRuleDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $patterns = $dto->getPatterns();
        if (!is_null($patterns)) {

            /** @var Collection<array-key, OutgoingDdiRulesPatternInterface> $replacement */
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
     * @param OutgoingDdiRuleDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $patterns = $dto->getPatterns();
        if (!is_null($patterns)) {

            /** @var Collection<array-key, OutgoingDdiRulesPatternInterface> $replacement */
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
    public function toDto(int $depth = 0): OutgoingDdiRuleDto
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

    public function addPattern(OutgoingDdiRulesPatternInterface $pattern): OutgoingDdiRuleInterface
    {
        $this->patterns->add($pattern);

        return $this;
    }

    public function removePattern(OutgoingDdiRulesPatternInterface $pattern): OutgoingDdiRuleInterface
    {
        $this->patterns->removeElement($pattern);

        return $this;
    }

    /**
     * @param Collection<array-key, OutgoingDdiRulesPatternInterface> $patterns
     */
    public function replacePatterns(Collection $patterns): OutgoingDdiRuleInterface
    {
        foreach ($patterns as $entity) {
            $entity->setOutgoingDdiRule($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->patterns as $key => $entity) {
            /**
             * @psalm-suppress MixedArgument
             */
            $currentValue = array_map(
                $toStringCallable,
                (function (): array {
                    return $this->__toArray(); /** @phpstan-ignore-line */
                })->call($entity)
            );

            $match = false;
            foreach ($patterns as $newKey => $newEntity) {
                /**
                 * @psalm-suppress MixedArgument
                 */
                $newValue = array_map(
                    $toStringCallable,
                    (function (): array {
                        return $this->__toArray(); /** @phpstan-ignore-line */
                    })->call($newEntity)
                );

                $diff = array_diff_assoc(
                    $currentValue,
                    $newValue
                );
                unset($diff['id']);

                if (empty($diff)) {
                    unset($patterns[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->patterns->remove($key);
            }
        }

        foreach ($patterns as $entity) {
            $this->addPattern($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, OutgoingDdiRulesPatternInterface>
     */
    public function getPatterns(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->patterns->matching($criteria)->toArray();
        }

        return $this->patterns->toArray();
    }
}
