<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

interface OutgoingRoutingInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * @return array|RoutingPatternInterface[]
     */
    public function getRoutingPatterns();

    /**
     * @param RoutingPatternInterface $pattern
     */
    public function hasRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $pattern);

    /**
     * Set type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type = null);

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

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
     * Set weight
     *
     * @param integer $weight
     *
     * @return self
     */
    public function setWeight($weight);

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Set peeringContract
     *
     * @param \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface $peeringContract
     *
     * @return self
     */
    public function setPeeringContract(\Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface $peeringContract = null);

    /**
     * Get peeringContract
     *
     * @return \Ivoz\Provider\Domain\Model\PeeringContract\PeeringContractInterface
     */
    public function getPeeringContract();

    /**
     * Set routingPattern
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern
     *
     * @return self
     */
    public function setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern = null);

    /**
     * Get routingPattern
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface
     */
    public function getRoutingPattern();

    /**
     * Set routingPatternGroup
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface $routingPatternGroup
     *
     * @return self
     */
    public function setRoutingPatternGroup(\Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface $routingPatternGroup = null);

    /**
     * Get routingPatternGroup
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupInterface
     */
    public function getRoutingPatternGroup();

    /**
     * Set routingTag
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag
     *
     * @return self
     */
    public function setRoutingTag(\Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface $routingTag = null);

    /**
     * Get routingTag
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface
     */
    public function getRoutingTag();

    /**
     * Add lcrRule
     *
     * @param \Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface $lcrRule
     *
     * @return OutgoingRoutingTrait
     */
    public function addLcrRule(\Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface $lcrRule);

    /**
     * Remove lcrRule
     *
     * @param \Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface $lcrRule
     */
    public function removeLcrRule(\Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface $lcrRule);

    /**
     * Replace lcrRules
     *
     * @param \Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface[] $lcrRules
     * @return self
     */
    public function replaceLcrRules(Collection $lcrRules);

    /**
     * Get lcrRules
     *
     * @return \Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface[]
     */
    public function getLcrRules(\Doctrine\Common\Collections\Criteria $criteria = null);

}

