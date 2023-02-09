<?php

namespace Ivoz\Ast\Domain\Model\Queue;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* QueueInterface
*/
interface QueueInterface extends LoggableEntityInterface
{
    public const AUTOPAUSE_YES = 'yes';

    public const AUTOPAUSE_NO = 'no';

    public const AUTOPAUSE_ALL = 'all';

    public const RINGINUSE_YES = 'yes';

    public const RINGINUSE_NO = 'no';

    public const STRATEGY_RINGALL = 'ringall';

    public const STRATEGY_LEASTRECENT = 'leastrecent';

    public const STRATEGY_FEWESTCALLS = 'fewestcalls';

    public const STRATEGY_RANDOM = 'random';

    public const STRATEGY_RRMEMORY = 'rrmemory';

    public const STRATEGY_LINEAR = 'linear';

    public const STRATEGY_WRANDOM = 'wrandom';

    public const STRATEGY_RRORDERED = 'rrordered';

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return int
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): QueueDto;

    /**
     * @internal use EntityTools instead
     * @param null|QueueInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?QueueDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param QueueDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): QueueDto;

    public function getName(): string;

    public function getPeriodicAnnounce(): ?string;

    public function getPeriodicAnnounceFrequency(): ?int;

    public function getTimeout(): ?int;

    public function getAutopause(): string;

    public function getRinginuse(): string;

    public function getWrapuptime(): ?int;

    public function getMaxlen(): ?int;

    public function getStrategy(): ?string;

    public function getWeight(): ?int;

    public function getQueue(): \Ivoz\Provider\Domain\Model\Queue\QueueInterface;

    public function isInitialized(): bool;
}
