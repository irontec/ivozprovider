<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;

/**
* ExternalCallFilterBlackListInterface
*/
interface ExternalCallFilterBlackListInterface extends LoggableEntityInterface
{
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

    public static function createDto(string|int|null $id = null): ExternalCallFilterBlackListDto;

    /**
     * @internal use EntityTools instead
     * @param null|ExternalCallFilterBlackListInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ExternalCallFilterBlackListDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ExternalCallFilterBlackListDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ExternalCallFilterBlackListDto;

    public function setFilter(?ExternalCallFilterInterface $filter = null): static;

    public function getFilter(): ?ExternalCallFilterInterface;

    public function getMatchlist(): MatchListInterface;
}
