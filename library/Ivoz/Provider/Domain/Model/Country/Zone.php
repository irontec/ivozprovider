<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Country;

use Assert\Assertion;

/**
* Zone
* @codeCoverageIgnore
*/
class Zone
{
    /**
     * column: zone_en
     * @var string
     */
    protected $en = '';

    /**
     * column: zone_es
     * @var string
     */
    protected $es = '';

    /**
     * column: zone_ca
     * @var string
     */
    protected $ca = '';

    /**
     * column: zone_it
     * @var string
     */
    protected $it = '';

    /**
     * Constructor
     */
    public function __construct(
        $en,
        $es,
        $ca,
        $it
    ) {
        $this->setEn($en);
        $this->setEs($es);
        $this->setCa($ca);
        $this->setIt($it);
    }

    /**
     * Equals
     */
    public function equals(self $zone)
    {
        return
            $this->getEn() === $zone->getEn() &&
            $this->getEs() === $zone->getEs() &&
            $this->getCa() === $zone->getCa() &&
            $this->getIt() === $zone->getIt();
    }

    /**
     * Set en
     *
     * @param string $en
     *
     * @return static
     */
    protected function setEn(string $en): Zone
    {
        Assertion::maxLength($en, 55, 'en value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->en = $en;

        return $this;
    }

    /**
     * Get en
     *
     * @return string
     */
    public function getEn(): string
    {
        return $this->en;
    }

    /**
     * Set es
     *
     * @param string $es
     *
     * @return static
     */
    protected function setEs(string $es): Zone
    {
        Assertion::maxLength($es, 55, 'es value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->es = $es;

        return $this;
    }

    /**
     * Get es
     *
     * @return string
     */
    public function getEs(): string
    {
        return $this->es;
    }

    /**
     * Set ca
     *
     * @param string $ca
     *
     * @return static
     */
    protected function setCa(string $ca): Zone
    {
        Assertion::maxLength($ca, 55, 'ca value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ca = $ca;

        return $this;
    }

    /**
     * Get ca
     *
     * @return string
     */
    public function getCa(): string
    {
        return $this->ca;
    }

    /**
     * Set it
     *
     * @param string $it
     *
     * @return static
     */
    protected function setIt(string $it): Zone
    {
        Assertion::maxLength($it, 55, 'it value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->it = $it;

        return $this;
    }

    /**
     * Get it
     *
     * @return string
     */
    public function getIt(): string
    {
        return $this->it;
    }

}
