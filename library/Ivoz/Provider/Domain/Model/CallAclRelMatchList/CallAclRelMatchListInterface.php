<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelMatchList;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface CallAclRelMatchListInterface extends LoggableEntityInterface
{
    const POLICY_ALLOW = 'allow';
    const POLICY_DENY = 'deny';


    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority();

    /**
     * Get policy
     *
     * @return string
     */
    public function getPolicy();

    /**
     * Set callAcl
     *
     * @param \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl | null
     *
     * @return static
     */
    public function setCallAcl(\Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl = null);

    /**
     * Get callAcl
     *
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface | null
     */
    public function getCallAcl();

    /**
     * Get matchList
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    public function getMatchList();
}
