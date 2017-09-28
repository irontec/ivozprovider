<?php

namespace Ivoz\Provider\Domain\Model\Timezone;

use Assert\Assertion;

/**
 * Label
 * @codeCoverageIgnore
 */
class Label
{
    /**
     * @column timeZoneLabel_en
     * @var string
     */
    protected $en = '';

    /**
     * @column timeZoneLabel_es
     * @var string
     */
    protected $es = '';


    /**
     * Constructor
     */
    public function __construct($en, $es)
    {
        $this->setEn($en);
        $this->setEs($es);
    }

    // @codeCoverageIgnoreStart

    /**
     * Set en
     *
     * @param string $en
     *
     * @return self
     */
    protected function setEn($en)
    {
        Assertion::notNull($en);
        Assertion::maxLength($en, 20);

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
     * @return self
     */
    protected function setEs($es)
    {
        Assertion::notNull($es);
        Assertion::maxLength($es, 20);

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



    // @codeCoverageIgnoreEnd
}

