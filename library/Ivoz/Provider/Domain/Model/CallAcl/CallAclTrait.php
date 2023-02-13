<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait CallAclTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, CallAclRelMatchListInterface> & Selectable<array-key, CallAclRelMatchListInterface>
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

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CallAclDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $relMatchLists = $dto->getRelMatchLists();
        if (!is_null($relMatchLists)) {

            /** @var Collection<array-key, CallAclRelMatchListInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relMatchLists
            );
            $self->replaceRelMatchLists($replacement);
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $relMatchLists = $dto->getRelMatchLists();
        if (!is_null($relMatchLists)) {

            /** @var Collection<array-key, CallAclRelMatchListInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relMatchLists
            );
            $this->replaceRelMatchLists($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CallAclDto
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

    /**
     * @param Collection<array-key, CallAclRelMatchListInterface> $relMatchLists
     */
    public function replaceRelMatchLists(Collection $relMatchLists): CallAclInterface
    {
        foreach ($relMatchLists as $entity) {
            $entity->setCallAcl($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relMatchLists as $key => $entity) {
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
            foreach ($relMatchLists as $newKey => $newEntity) {
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
                    unset($relMatchLists[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relMatchLists->remove($key);
            }
        }

        foreach ($relMatchLists as $entity) {
            $this->addRelMatchList($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, CallAclRelMatchListInterface>
     */
    public function getRelMatchLists(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relMatchLists->matching($criteria)->toArray();
        }

        return $this->relMatchLists->toArray();
    }
}
