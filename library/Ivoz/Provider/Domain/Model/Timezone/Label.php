<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Timezone;

use Assert\Assertion;

/**
* Label
* @codeCoverageIgnore
*/
class Label
{
    /**
     * column: timeZoneLabel_en
     * @var string
     */
    protected $en = '';

    /**
     * column: timeZoneLabel_es
     * @var string
     */
    protected $es = '';

    /**
     * column: timeZoneLabel_ca
     * @var string
     */
    protected $ca = '';

    /**
     * column: timeZoneLabel_it
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
    public function equals(self $label)
    {
        return
            $this->getEn() === $label->getEn() &&
            $this->getEs() === $label->getEs() &&
            $this->getCa() === $label->getCa() &&
            $this->getIt() === $label->getIt();
    }

    /**
     * Set en
     *
     * @param string $en
     *
     * @return static
     */
    protected function setEn(string $en): Label
    {
        Assertion::maxLength($en, 20, 'en value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setEs(string $es): Label
    {
        Assertion::maxLength($es, 20, 'es value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setCa(string $ca): Label
    {
        Assertion::maxLength($ca, 20, 'ca value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setIt(string $it): Label
    {
        Assertion::maxLength($it, 20, 'it value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
