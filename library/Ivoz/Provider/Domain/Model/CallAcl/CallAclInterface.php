<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface CallAclInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @param $dst
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
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

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
     * @return CallAclTrait
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
     * @param \Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface[] $relMatchLists
     * @return self
     */
    public function replaceRelMatchLists(Collection $relMatchLists);

    /**
     * Get relMatchLists
     *
     * @return \Ivoz\Provider\Domain\Model\CallAclRelMatchList\CallAclRelMatchListInterface[]
     */
    public function getRelMatchLists(\Doctrine\Common\Collections\Criteria $criteria = null);
}
