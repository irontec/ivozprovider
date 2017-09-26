<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

/**
 * CallAcl
 */
class CallAcl extends CallAclAbstract implements CallAclInterface
{
    use CallAclTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $dst
     * @return bool
     */
    public function dstIsCallable($dst)
    {
        /**
         * @var CallAcl $this
         */
        $defaultPolicy = $this->getDefaultPolicy();

        $criteria = Criteria
            ::create()
            ->orderBy(['priority' => Criteria::ASC]);

        $aclRelPatterns = $this->getRelPatterns($criteria);

        /**
         * @var CallAclRelPattern $aclRelPattern
         */
        foreach($aclRelPatterns as $aclRelPattern) {
            $aclPattern = $aclRelPattern->getCallAclPattern();
            $policy = $aclRelPattern->getPolicy();
            $pattern = $aclPattern->getRegExp();
            $match = preg_match('/'.$pattern.'/', $dst);

            if($match) {
                return 'allow' === $policy;
            }
        }

        return 'allow' === $defaultPolicy;
    }
}

