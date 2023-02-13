<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Extension;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait ExtensionTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, UserInterface> & Selectable<array-key, UserInterface>
     * UserInterface mappedBy extension
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

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExtensionDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $users = $dto->getUsers();
        if (!is_null($users)) {

            /** @var Collection<array-key, UserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $users
            );
            $self->replaceUsers($replacement);
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
     * @param ExtensionDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $users = $dto->getUsers();
        if (!is_null($users)) {

            /** @var Collection<array-key, UserInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $users
            );
            $this->replaceUsers($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ExtensionDto
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

    public function addUser(UserInterface $user): ExtensionInterface
    {
        $this->users->add($user);

        return $this;
    }

    public function removeUser(UserInterface $user): ExtensionInterface
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     * @param Collection<array-key, UserInterface> $users
     */
    public function replaceUsers(Collection $users): ExtensionInterface
    {
        foreach ($users as $entity) {
            $entity->setExtension($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->users as $key => $entity) {
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
            foreach ($users as $newKey => $newEntity) {
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
                    unset($users[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->users->remove($key);
            }
        }

        foreach ($users as $entity) {
            $this->addUser($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, UserInterface>
     */
    public function getUsers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->users->matching($criteria)->toArray();
        }

        return $this->users->toArray();
    }
}
