<?php

namespace Ivoz\Provider\Domain\Model\Service;

use Assert\Assertion;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * Description
 * @codeCoverageIgnore
 */
class Description
{
    /**
     * column: description_en
     * @var string
     */
    protected $en = '';

    /**
     * column: description_es
     * @var string
     */
    protected $es = '';

    /**
     * column: description_ca
     * @var string
     */
    protected $ca = '';

    /**
     * column: description_it
     * @var string
     */
    protected $it = '';


    /**
     * Constructor
     */
    public function __construct($en, $es, $ca, $it)
    {
        $this->setEn($en);
        $this->setEs($es);
        $this->setCa($ca);
        $this->setIt($it);
    }

    /**
     * Equals
     */
    public function equals(self $description)
    {
        return
            $this->getEn() === $description->getEn() &&
            $this->getEs() === $description->getEs() &&
            $this->getCa() === $description->getCa() &&
            $this->getIt() === $description->getIt();
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
        Assertion::maxLength($en, 255, 'en value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setEs($es)
    {
        Assertion::notNull($es, 'es value "%s" is null, but non null value was expected.');
        Assertion::maxLength($es, 255, 'es value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setCa($ca)
    {
        Assertion::notNull($ca, 'ca value "%s" is null, but non null value was expected.');
        Assertion::maxLength($ca, 255, 'ca value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setIt($it)
    {
        Assertion::notNull($it, 'it value "%s" is null, but non null value was expected.');
        Assertion::maxLength($it, 255, 'it value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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

    // @codeCoverageIgnoreEnd
}
