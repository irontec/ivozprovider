<?php

namespace Ivoz\Provider\Domain\Model\Timezone;

use Assert\Assertion;
use Ivoz\Core\Domain\Model\EntityInterface;

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
     * Constructor
     */
    public function __construct($en, $es, $ca)
    {
        $this->setEn($en);
        $this->setEs($es);
        $this->setCa($ca);
    }

    // @codeCoverageIgnoreStart

    /**
     * Set en
     *
     * @param string $en
     *
     * @return static
     */
    protected function setEn($en)
    {
        Assertion::notNull($en, 'en value "%s" is null, but non null value was expected.');
        Assertion::maxLength($en, 20, 'en value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->en = $en;

        return $this;
    }

    /**
     * Get en
     *
     * @return string
     */
    public function getEn()
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
    protected function setEs($es)
    {
        Assertion::notNull($es, 'es value "%s" is null, but non null value was expected.');
        Assertion::maxLength($es, 20, 'es value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->es = $es;

        return $this;
    }

    /**
     * Get es
     *
     * @return string
     */
    public function getEs()
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
    protected function setCa($ca)
    {
        Assertion::notNull($ca, 'ca value "%s" is null, but non null value was expected.');
        Assertion::maxLength($ca, 20, 'ca value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ca = $ca;

        return $this;
    }

    /**
     * Get ca
     *
     * @return string
     */
    public function getCa()
    {
        return $this->ca;
    }

    // @codeCoverageIgnoreEnd
}
