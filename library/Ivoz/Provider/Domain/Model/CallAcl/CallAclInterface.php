<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* CallAclInterface
*/
interface CallAclInterface extends LoggableEntityInterface
{
    const DEFAULTPOLICY_ALLOW = 'allow';

    const DEFAULTPOLICY_DENY = 'deny';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @param string $dst
     * @return bool
     */
    public function dstIsCallable($dst);

    public function getName(): string;

    public function getDefaultPolicy(): string;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;

    public function addRelMatchList(CallAclRelMatchListInterface $relMatchList): CallAclInterface;

    public function removeRelMatchList(CallAclRelMatchListInterface $relMatchList): CallAclInterface;

    public function replaceRelMatchLists(ArrayCollection $relMatchLists): CallAclInterface;

    public function getRelMatchLists(?Criteria $criteria = null): array;
}
