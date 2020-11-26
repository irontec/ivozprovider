<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelMatchList;

use Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* CallAclRelMatchListInterface
*/
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
     * @return int
     */
    public function getPriority(): int;

    /**
     * Get policy
     *
     * @return string
     */
    public function getPolicy(): string;

    /**
     * Set callAcl
     *
     * @param CallAclInterface | null
     *
     * @return static
     */
    public function setCallAcl(?CallAclInterface $callAcl = null): CallAclRelMatchListInterface;

    /**
     * Get callAcl
     *
     * @return CallAclInterface | null
     */
    public function getCallAcl(): ?CallAclInterface;

    /**
     * Get matchList
     *
     * @return MatchListInterface
     */
    public function getMatchList(): MatchListInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
