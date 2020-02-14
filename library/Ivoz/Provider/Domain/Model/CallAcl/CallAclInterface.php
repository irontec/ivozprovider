<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

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
    public function getName();

    /**
     * Get defaultPolicy
     *
     * @return string
     */
    public function getDefaultPolicy();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Add relMatchList
     *
     * @param \Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface $relMatchList
     *
     * @return static
     */
    public function addRelMatchList(\Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface $relMatchList);

    /**
     * Remove relMatchList
     *
     * @param \Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface $relMatchList
     */
    public function removeRelMatchList(\Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface $relMatchList);

    /**
     * Replace relMatchLists
     *
     * @param ArrayCollection $relMatchLists of Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface
     * @return static
     */
    public function replaceRelMatchLists(ArrayCollection $relMatchLists);

    /**
     * Get relMatchLists
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface[]
     */
    public function getRelMatchLists(\Doctrine\Common\Collections\Criteria $criteria = null);
}
