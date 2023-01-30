<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* CallAclInterface
*/
interface CallAclInterface extends LoggableEntityInterface
{
    public const DEFAULTPOLICY_ALLOW = 'allow';

    public const DEFAULTPOLICY_DENY = 'deny';

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
     * @param string $dst
     * @return bool
     */
    public function dstIsCallable($dst);

    public static function createDto(string|int|null $id = null): CallAclDto;

    /**
     * @internal use EntityTools instead
     * @param null|CallAclInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CallAclDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CallAclDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CallAclDto;

    public function getName(): string;

    public function getDefaultPolicy(): string;

    public function getCompany(): CompanyInterface;

    public function addRelMatchList(CallAclRelMatchListInterface $relMatchList): CallAclInterface;

    public function removeRelMatchList(CallAclRelMatchListInterface $relMatchList): CallAclInterface;

    /**
     * @param Collection<array-key, CallAclRelMatchListInterface> $relMatchLists
     */
    public function replaceRelMatchLists(Collection $relMatchLists): CallAclInterface;

    /**
     * @return array<array-key, CallAclRelMatchListInterface>
     */
    public function getRelMatchLists(?Criteria $criteria = null): array;
}
