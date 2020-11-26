<?php

namespace Ivoz\Provider\Domain\Model\MatchListPattern;

use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* MatchListPatternInterface
*/
interface MatchListPatternInterface extends LoggableEntityInterface
{
    const TYPE_NUMBER = 'number';

    const TYPE_REGEXP = 'regexp';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get Number value in E.164 format
     * @return string
     */
    public function getNumberE164();

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription(): ?string;

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get regexp
     *
     * @return string | null
     */
    public function getRegexp(): ?string;

    /**
     * Get numbervalue
     *
     * @return string | null
     */
    public function getNumbervalue(): ?string;

    /**
     * Set matchList
     *
     * @param MatchListInterface
     *
     * @return static
     */
    public function setMatchList(MatchListInterface $matchList): MatchListPatternInterface;

    /**
     * Get matchList
     *
     * @return MatchListInterface
     */
    public function getMatchList(): MatchListInterface;

    /**
     * Get numberCountry
     *
     * @return CountryInterface | null
     */
    public function getNumberCountry(): ?CountryInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
