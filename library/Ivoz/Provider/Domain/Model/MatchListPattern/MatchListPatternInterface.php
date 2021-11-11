<?php

namespace Ivoz\Provider\Domain\Model\MatchListPattern;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

/**
* MatchListPatternInterface
*/
interface MatchListPatternInterface extends LoggableEntityInterface
{
    public const TYPE_NUMBER = 'number';

    public const TYPE_REGEXP = 'regexp';

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * Get Number value in E.164 format
     * @return string
     */
    public function getNumberE164();

    public static function createDto(string|int|null $id = null): MatchListPatternDto;

    /**
     * @internal use EntityTools instead
     * @param null|MatchListPatternInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?MatchListPatternDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): MatchListPatternDto;

    public function getDescription(): ?string;

    public function getType(): string;

    public function getRegexp(): ?string;

    public function getNumbervalue(): ?string;

    public function setMatchList(MatchListInterface $matchList): static;

    public function getMatchList(): MatchListInterface;

    public function getNumberCountry(): ?CountryInterface;

    public function isInitialized(): bool;
}
