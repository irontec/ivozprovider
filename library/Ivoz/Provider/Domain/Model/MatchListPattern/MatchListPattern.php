<?php

namespace Ivoz\Provider\Domain\Model\MatchListPattern;

/**
 * MatchListPattern
 */
class MatchListPattern extends MatchListPatternAbstract implements MatchListPatternInterface
{
    use MatchListPatternTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Number value in E.164 format
     * @param $prefix string
     */
    public function getNumberE164()
    {
        $callingCode = $this
            ->getNumberCountry()
            ->getCountryCode();

        return
            $callingCode .
            $this->getNumberValue();
    }
}

