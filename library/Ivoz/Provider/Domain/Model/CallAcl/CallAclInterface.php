<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @return array
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
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CallAclDto;

    public function getName(): string;

    public function getDefaultPolicy(): string;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;

    public function addRelMatchList(CallAclRelMatchListInterface $relMatchList): CallAclInterface;

    public function removeRelMatchList(CallAclRelMatchListInterface $relMatchList): CallAclInterface;

    public function replaceRelMatchLists(ArrayCollection $relMatchLists): CallAclInterface;

    public function getRelMatchLists(?Criteria $criteria = null): array;
}
