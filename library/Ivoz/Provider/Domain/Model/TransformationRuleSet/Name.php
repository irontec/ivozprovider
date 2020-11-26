<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Assert\Assertion;

/**
* Name
* @codeCoverageIgnore
*/
class Name
{
    /**
     * column: name_en
     * @var string
     */
    protected $en;

    /**
     * column: name_es
     * @var string
     */
    protected $es;

    /**
     * column: name_ca
     * @var string
     */
    protected $ca;

    /**
     * column: name_it
     * @var string
     */
    protected $it;

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
    public function equals(self $name)
    {
        return
            $this->getEn() === $name->getEn() &&
            $this->getEs() === $name->getEs() &&
            $this->getCa() === $name->getCa() &&
            $this->getIt() === $name->getIt();
    }

    /**
     * Set en
     *
     * @param string $en
     *
     * @return static
     */
    protected function setEn(string $en): Name
    {
        Assertion::maxLength($en, 100, 'en value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setEs(string $es): Name
    {
        Assertion::maxLength($es, 100, 'es value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setCa(string $ca): Name
    {
        Assertion::maxLength($ca, 100, 'ca value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setIt(string $it): Name
    {
        Assertion::maxLength($it, 100, 'it value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
