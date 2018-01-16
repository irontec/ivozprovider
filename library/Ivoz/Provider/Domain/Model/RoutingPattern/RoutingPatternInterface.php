<?php

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

use Ivoz\Core\Domain\Model\EntityInterface;
use Doctrine\Common\Collections\Collection;

interface RoutingPatternInterface extends EntityInterface
{
    public function __toString();

    /**
     * Set regExp
     *
     * @param string $regExp
     *
     * @return self
     */
    public function setRegExp($regExp);

    /**
     * Get regExp
     *
     * @return string
     */
    public function getRegExp();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\Name $name
     *
     * @return self
     */
    public function setName(\Ivoz\Provider\Domain\Model\RoutingPattern\Name $name);

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\Name
     */
    public function getName();

    /**
     * Set description
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\Description $description
     *
     * @return self
     */
    public function setDescription(\Ivoz\Provider\Domain\Model\RoutingPattern\Description $description);

    /**
     * Get description
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\Description
     */
    public function getDescription();

    /**
     * Add lcrRule
     *
     * @param \Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface $lcrRule
     *
     * @return RoutingPatternTrait
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
     * @return array
     */
    public function getLcrRules(\Doctrine\Common\Collections\Criteria $criteria = null);

}

