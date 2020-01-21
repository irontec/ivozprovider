<?php

namespace Ivoz\Provider\Domain\Model\MatchList;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface MatchListInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Check if the given number matches the list rules
     *
     * @param string $number in E164 form
     * @return bool true if number matches, false otherwise
     */
    public function numberMatches($number);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand | null
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company | null
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany();

    /**
     * Add pattern
     *
     * @param \Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface $pattern
     *
     * @return static
     */
    public function addPattern(\Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface $pattern);

    /**
     * Remove pattern
     *
     * @param \Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface $pattern
     */
    public function removePattern(\Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface $pattern);

    /**
     * Replace patterns
     *
     * @param ArrayCollection $patterns of Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface
     * @return static
     */
    public function replacePatterns(ArrayCollection $patterns);

    /**
     * Get patterns
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface[]
     */
    public function getPatterns(\Doctrine\Common\Collections\Criteria $criteria = null);
}
