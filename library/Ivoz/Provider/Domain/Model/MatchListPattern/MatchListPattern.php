<?php

namespace Ivoz\Provider\Domain\Model\MatchListPattern;

/**
 * MatchListPattern
 */
class MatchListPattern extends MatchListPatternAbstract implements MatchListPatternInterface
{
    use MatchListPatternTrait;

    /**
     * Get id
     *
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
    public function getNumberE164($prefix = '')
    {
        $callingCode = $this
            ->getNumberCountry()
            ->getCallingCode();

        return
            $prefix .
            $callingCode .
            $this->getNumberValue();
    }
}

