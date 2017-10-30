<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelPattern;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface CallAclRelPatternInterface extends LoggableEntityInterface
{
    public function getChangeSet();

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    public function setPriority($priority);

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority();

    /**
     * Set policy
     *
     * @param string $policy
     *
     * @return self
     */
    public function setPolicy($policy);

    /**
     * Get policy
     *
     * @return string
     */
    public function getPolicy();

    /**
     * Set callAcl
     *
     * @param \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl
     *
     * @return self
     */
    public function setCallAcl(\Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl = null);

    /**
     * Get callAcl
     *
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface
     */
    public function getCallAcl();

    /**
     * Set callAclPattern
     *
     * @param \Ivoz\Provider\Domain\Model\CallAclPattern\CallAclPatternInterface $callAclPattern
     *
     * @return self
     */
    public function setCallAclPattern(\Ivoz\Provider\Domain\Model\CallAclPattern\CallAclPatternInterface $callAclPattern);

    /**
     * Get callAclPattern
     *
     * @return \Ivoz\Provider\Domain\Model\CallAclPattern\CallAclPatternInterface
     */
    public function getCallAclPattern();

}

