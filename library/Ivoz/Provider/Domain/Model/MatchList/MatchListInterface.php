<?php

namespace Ivoz\Provider\Domain\Model\MatchList;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\MatchListPattern\MatchListPatternInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

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

    public function getName(): string;

    public function setBrand(?BrandInterface $brand = null): static;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    public function addPattern(MatchListPatternInterface $pattern): MatchListInterface;

    public function removePattern(MatchListPatternInterface $pattern): MatchListInterface;

    public function replacePatterns(ArrayCollection $patterns): MatchListInterface;

    public function getPatterns(?Criteria $criteria = null): array;
}
