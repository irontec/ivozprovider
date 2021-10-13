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
    public function getChangeSet(): array
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
     * @return string
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

    protected function sanitizeValues()
    {
        {
            $nullableFields = [
                'number' => 'numberValue',
                'regexp' => 'regExp',
            ];
            $patternType = $this->getType();
            foreach ($nullableFields as $type => $fieldName) {
                if ($patternType == $type) {
                    continue;
                }
                $setter = 'set' . ucfirst($fieldName);
                $this->{$setter}(null);
            }
            }
    }
}
