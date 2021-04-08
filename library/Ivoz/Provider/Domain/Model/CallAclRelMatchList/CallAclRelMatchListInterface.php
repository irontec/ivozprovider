<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelMatchList;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;

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

    public function getPriority(): int;

    public function getPolicy(): string;

    public function setCallAcl(?CallAclInterface $callAcl = null): static;

    public function getCallAcl(): ?CallAclInterface;

    public function getMatchList(): MatchListInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
