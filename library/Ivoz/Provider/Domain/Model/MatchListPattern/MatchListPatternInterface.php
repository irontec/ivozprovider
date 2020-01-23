<?php

namespace Ivoz\Provider\Domain\Model\MatchListPattern;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function getDescription();

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

    /**
     * Get regexp
     *
     * @return string | null
     */
    public function getRegexp();

    /**
     * Get numbervalue
     *
     * @return string | null
     */
    public function getNumbervalue();

    /**
     * Set matchList
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList
     *
     * @return static
     */
    public function setMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList);

    /**
     * Get matchList
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    public function getMatchList();

    /**
     * Get numberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getNumberCountry();
}
