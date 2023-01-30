<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelMatchList;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;

/**
* CallAclRelMatchListInterface
*/
interface CallAclRelMatchListInterface extends LoggableEntityInterface
{
    public const POLICY_ALLOW = 'allow';

    public const POLICY_DENY = 'deny';

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

    public static function createDto(string|int|null $id = null): CallAclRelMatchListDto;

    /**
     * @internal use EntityTools instead
     * @param null|CallAclRelMatchListInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CallAclRelMatchListDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CallAclRelMatchListDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CallAclRelMatchListDto;

    public function getPriority(): int;

    public function getPolicy(): string;

    public function setCallAcl(?CallAclInterface $callAcl = null): static;

    public function getCallAcl(): ?CallAclInterface;

    public function getMatchList(): MatchListInterface;
}
