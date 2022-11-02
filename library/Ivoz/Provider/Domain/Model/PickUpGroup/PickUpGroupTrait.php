<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\PickUpGroup;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait PickUpGroupTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, PickUpRelUserInterface> & Selectable<array-key, PickUpRelUserInterface>
     * PickUpRelUserInterface mappedBy pickUpGroup
     * orphanRemoval
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

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param PickUpGroupDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $relUsers = $dto->getRelUsers();
        if (!is_null($relUsers)) {

            /** @var Collection<array-key, PickUpRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relUsers
            );
            $self->replaceRelUsers($replacement);
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $relUsers = $dto->getRelUsers();
        if (!is_null($relUsers)) {

            /** @var Collection<array-key, PickUpRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $relUsers
            );
            $this->replaceRelUsers($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): PickUpGroupDto
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

    public function addRelUser(PickUpRelUserInterface $relUser): PickUpGroupInterface
    {
        $this->relUsers->add($relUser);

        return $this;
    }

    public function removeRelUser(PickUpRelUserInterface $relUser): PickUpGroupInterface
    {
        $this->relUsers->removeElement($relUser);

        return $this;
    }

    /**
     * @param Collection<array-key, PickUpRelUserInterface> $relUsers
     */
    public function replaceRelUsers(Collection $relUsers): PickUpGroupInterface
    {
        foreach ($relUsers as $entity) {
            $entity->setPickUpGroup($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->relUsers as $key => $entity) {
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
            foreach ($relUsers as $newKey => $newEntity) {
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
                    unset($relUsers[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->relUsers->remove($key);
            }
        }

        foreach ($relUsers as $entity) {
            $this->addRelUser($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, PickUpRelUserInterface>
     */
    public function getRelUsers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->relUsers->matching($criteria)->toArray();
        }

        return $this->relUsers->toArray();
    }
}
