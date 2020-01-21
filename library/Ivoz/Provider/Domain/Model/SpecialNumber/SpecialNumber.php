<?php

namespace Ivoz\Provider\Domain\Model\SpecialNumber;

/**
 * SpecialNumber
 */
class SpecialNumber extends SpecialNumberAbstract implements SpecialNumberInterface
{
    use SpecialNumberTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    protected function sanitizeValues()
    {
        $country = $this->getCountry();

        $this->setNumberE164(
            $country->getCountryCode()
            . $this->getNumber()
        );
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
}
