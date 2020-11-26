<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get defaultPolicy
     *
     * @return string
     */
    public function getDefaultPolicy(): string;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add relMatchList
     *
     * @param CallAclRelMatchListInterface $relMatchList
     *
     * @return static
     */
    public function addRelMatchList(CallAclRelMatchListInterface $relMatchList): CallAclInterface;

    /**
     * Remove relMatchList
     *
     * @param CallAclRelMatchListInterface $relMatchList
     *
     * @return static
     */
    public function removeRelMatchList(CallAclRelMatchListInterface $relMatchList): CallAclInterface;

    /**
     * Replace relMatchLists
     *
     * @param ArrayCollection $relMatchLists of CallAclRelMatchListInterface
     *
     * @return static
     */
    public function replaceRelMatchLists(ArrayCollection $relMatchLists): CallAclInterface;

    /**
     * Get relMatchLists
     * @param Criteria | null $criteria
     * @return CallAclRelMatchListInterface[]
     */
    public function getRelMatchLists(?Criteria $criteria = null): array;

}
