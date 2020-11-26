<?php

namespace Ivoz\Provider\Domain\Model\MatchList;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* MatchListInterface
*/
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
    public function getName(): string;

    /**
     * Set brand
     *
     * @param BrandInterface | null
     *
     * @return static
     */
    public function setBrand(?BrandInterface $brand = null): MatchListInterface;

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface;

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add pattern
     *
     * @param MatchListPatternInterface $pattern
     *
     * @return static
     */
    public function addPattern(MatchListPatternInterface $pattern): MatchListInterface;

    /**
     * Remove pattern
     *
     * @param MatchListPatternInterface $pattern
     *
     * @return static
     */
    public function removePattern(MatchListPatternInterface $pattern): MatchListInterface;

    /**
     * Replace patterns
     *
     * @param ArrayCollection $patterns of MatchListPatternInterface
     *
     * @return static
     */
    public function replacePatterns(ArrayCollection $patterns): MatchListInterface;

    /**
     * Get patterns
     * @param Criteria | null $criteria
     * @return MatchListPatternInterface[]
     */
    public function getPatterns(?Criteria $criteria = null): array;

}
