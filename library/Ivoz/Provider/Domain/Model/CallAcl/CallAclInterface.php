<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Ivoz\Core\Domain\Model\EntityInterface;
use Doctrine\Common\Collections\Collection;

interface CallAclInterface extends EntityInterface
{
    /**
     * @param $dst
     * @return bool
     */
    public function dstIsCallable($dst);

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set defaultPolicy
     *
     * @param string $defaultPolicy
     *
     * @return self
     */
    public function setDefaultPolicy($defaultPolicy);

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
     * Add relPattern
     *
     * @param \Ivoz\Provider\Domain\Model\CallAclRelPattern\CallAclRelPatternInterface $relPattern
     *
     * @return CallAclTrait
     */
    public function addRelPattern(\Ivoz\Provider\Domain\Model\CallAclRelPattern\CallAclRelPatternInterface $relPattern);

    /**
     * Remove relPattern
     *
     * @param \Ivoz\Provider\Domain\Model\CallAclRelPattern\CallAclRelPatternInterface $relPattern
     */
    public function removeRelPattern(\Ivoz\Provider\Domain\Model\CallAclRelPattern\CallAclRelPatternInterface $relPattern);

    /**
     * Replace relPatterns
     *
     * @param \Ivoz\Provider\Domain\Model\CallAclRelPattern\CallAclRelPatternInterface[] $relPatterns
     * @return self
     */
    public function replaceRelPatterns(Collection $relPatterns);

    /**
     * Get relPatterns
     *
     * @return array
     */
    public function getRelPatterns(\Doctrine\Common\Collections\Criteria $criteria = null);

}

