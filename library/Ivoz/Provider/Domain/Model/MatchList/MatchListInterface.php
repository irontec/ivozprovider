<?php

namespace Ivoz\Provider\Domain\Model\MatchList;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Collection;

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
     * @return true if number matches, false otherwise
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
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
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
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
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
     * @return MatchListTrait
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
     * @param \Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface[] $patterns
     * @return self
     */
    public function replacePatterns(Collection $patterns);

    /**
     * Get patterns
     *
     * @return \Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface[]
     */
    public function getPatterns(\Doctrine\Common\Collections\Criteria $criteria = null);
}
