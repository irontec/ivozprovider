<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Fax;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\FaxesRelUser\FaxesRelUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait FaxTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, FaxesRelUserInterface> & Selectable<array-key, FaxesRelUserInterface>
     * FaxesRelUserInterface mappedBy fax
     * orphanRemoval
     */
    protected $faxesRelUsers;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->faxesRelUsers = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FaxDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $faxesRelUsers = $dto->getFaxesRelUsers();
        if (!is_null($faxesRelUsers)) {

            /** @var Collection<array-key, FaxesRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $faxesRelUsers
            );
            $self->replaceFaxesRelUsers($replacement);
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
     * @param FaxDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $faxesRelUsers = $dto->getFaxesRelUsers();
        if (!is_null($faxesRelUsers)) {

            /** @var Collection<array-key, FaxesRelUserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $faxesRelUsers
            );
            $this->replaceFaxesRelUsers($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FaxDto
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

    public function addFaxesRelUser(FaxesRelUserInterface $faxesRelUser): FaxInterface
    {
        $this->faxesRelUsers->add($faxesRelUser);

        return $this;
    }

    public function removeFaxesRelUser(FaxesRelUserInterface $faxesRelUser): FaxInterface
    {
        $this->faxesRelUsers->removeElement($faxesRelUser);

        return $this;
    }

    /**
     * @param Collection<array-key, FaxesRelUserInterface> $faxesRelUsers
     */
    public function replaceFaxesRelUsers(Collection $faxesRelUsers): FaxInterface
    {
        foreach ($faxesRelUsers as $entity) {
            $entity->setFax($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->faxesRelUsers as $key => $entity) {
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
            foreach ($faxesRelUsers as $newKey => $newEntity) {
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
                    unset($faxesRelUsers[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->faxesRelUsers->remove($key);
            }
        }

        foreach ($faxesRelUsers as $entity) {
            $this->addFaxesRelUser($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, FaxesRelUserInterface>
     */
    public function getFaxesRelUsers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->faxesRelUsers->matching($criteria)->toArray();
        }

        return $this->faxesRelUsers->toArray();
    }
}
