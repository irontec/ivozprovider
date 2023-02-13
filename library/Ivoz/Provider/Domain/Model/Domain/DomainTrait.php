<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Domain;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;

/**
* @codeCoverageIgnore
*/
trait DomainTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, FriendInterface> & Selectable<array-key, FriendInterface>
     * FriendInterface mappedBy domain
     */
    protected $friends;

    /**
     * @var Collection<array-key, ResidentialDeviceInterface> & Selectable<array-key, ResidentialDeviceInterface>
     * ResidentialDeviceInterface mappedBy domain
     */
    protected $residentialDevices;

    /**
     * @var Collection<array-key, TerminalInterface> & Selectable<array-key, TerminalInterface>
     * TerminalInterface mappedBy domain
     */
    protected $terminals;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->friends = new ArrayCollection();
        $this->residentialDevices = new ArrayCollection();
        $this->terminals = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DomainDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $friends = $dto->getFriends();
        if (!is_null($friends)) {

            /** @var Collection<array-key, FriendInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $friends
            );
            $self->replaceFriends($replacement);
        }

        $residentialDevices = $dto->getResidentialDevices();
        if (!is_null($residentialDevices)) {

            /** @var Collection<array-key, ResidentialDeviceInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $residentialDevices
            );
            $self->replaceResidentialDevices($replacement);
        }

        $terminals = $dto->getTerminals();
        if (!is_null($terminals)) {

            /** @var Collection<array-key, TerminalInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $terminals
            );
            $self->replaceTerminals($replacement);
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
     * @param DomainDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $friends = $dto->getFriends();
        if (!is_null($friends)) {

            /** @var Collection<array-key, FriendInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $friends
            );
            $this->replaceFriends($replacement);
        }

        $residentialDevices = $dto->getResidentialDevices();
        if (!is_null($residentialDevices)) {

            /** @var Collection<array-key, ResidentialDeviceInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $residentialDevices
            );
            $this->replaceResidentialDevices($replacement);
        }

        $terminals = $dto->getTerminals();
        if (!is_null($terminals)) {

            /** @var Collection<array-key, TerminalInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $terminals
            );
            $this->replaceTerminals($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DomainDto
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

    public function addFriend(FriendInterface $friend): DomainInterface
    {
        $this->friends->add($friend);

        return $this;
    }

    public function removeFriend(FriendInterface $friend): DomainInterface
    {
        $this->friends->removeElement($friend);

        return $this;
    }

    /**
     * @param Collection<array-key, FriendInterface> $friends
     */
    public function replaceFriends(Collection $friends): DomainInterface
    {
        foreach ($friends as $entity) {
            $entity->setDomain($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->friends as $key => $entity) {
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
            foreach ($friends as $newKey => $newEntity) {
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
                    unset($friends[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->friends->remove($key);
            }
        }

        foreach ($friends as $entity) {
            $this->addFriend($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, FriendInterface>
     */
    public function getFriends(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->friends->matching($criteria)->toArray();
        }

        return $this->friends->toArray();
    }

    public function addResidentialDevice(ResidentialDeviceInterface $residentialDevice): DomainInterface
    {
        $this->residentialDevices->add($residentialDevice);

        return $this;
    }

    public function removeResidentialDevice(ResidentialDeviceInterface $residentialDevice): DomainInterface
    {
        $this->residentialDevices->removeElement($residentialDevice);

        return $this;
    }

    /**
     * @param Collection<array-key, ResidentialDeviceInterface> $residentialDevices
     */
    public function replaceResidentialDevices(Collection $residentialDevices): DomainInterface
    {
        foreach ($residentialDevices as $entity) {
            $entity->setDomain($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->residentialDevices as $key => $entity) {
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
            foreach ($residentialDevices as $newKey => $newEntity) {
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
                    unset($residentialDevices[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->residentialDevices->remove($key);
            }
        }

        foreach ($residentialDevices as $entity) {
            $this->addResidentialDevice($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, ResidentialDeviceInterface>
     */
    public function getResidentialDevices(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->residentialDevices->matching($criteria)->toArray();
        }

        return $this->residentialDevices->toArray();
    }

    public function addTerminal(TerminalInterface $terminal): DomainInterface
    {
        $this->terminals->add($terminal);

        return $this;
    }

    public function removeTerminal(TerminalInterface $terminal): DomainInterface
    {
        $this->terminals->removeElement($terminal);

        return $this;
    }

    /**
     * @param Collection<array-key, TerminalInterface> $terminals
     */
    public function replaceTerminals(Collection $terminals): DomainInterface
    {
        foreach ($terminals as $entity) {
            $entity->setDomain($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->terminals as $key => $entity) {
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
            foreach ($terminals as $newKey => $newEntity) {
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
                    unset($terminals[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->terminals->remove($key);
            }
        }

        foreach ($terminals as $entity) {
            $this->addTerminal($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, TerminalInterface>
     */
    public function getTerminals(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->terminals->matching($criteria)->toArray();
        }

        return $this->terminals->toArray();
    }
}
