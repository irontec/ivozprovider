<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Timezone;

use Assert\Assertion;

/**
* Label
* @codeCoverageIgnore
*/
final class Label
{
    /**
     * column: timeZoneLabel_en
     */
    private $en = '';

    /**
     * column: timeZoneLabel_es
     */
    private $es = '';

    /**
     * column: timeZoneLabel_ca
     */
    private $ca = '';

    /**
     * column: timeZoneLabel_it
     */
    private $it = '';

    /**
     * Constructor
     */
    public function __construct(
        string $en,
        string $es,
        string $ca,
        string $it
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
        if ($this->getEn() !== $label->getEn()) {
            return false;
        }
        if ($this->getEs() !== $label->getEs()) {
            return false;
        }
        if ($this->getCa() !== $label->getCa()) {
            return false;
        }
        return $this->getIt() === $label->getIt();
    }

    protected function setEn(string $en): static
    {
        Assertion::maxLength($en, 20, 'en value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->en = $en;

        return $this;
    }

    public function getEn(): string
    {
        return $this->en;
    }

    protected function setEs(string $es): static
    {
        Assertion::maxLength($es, 20, 'es value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->es = $es;

        return $this;
    }

    public function getEs(): string
    {
        return $this->es;
    }

    protected function setCa(string $ca): static
    {
        Assertion::maxLength($ca, 20, 'ca value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ca = $ca;

        return $this;
    }

    public function getCa(): string
    {
        return $this->ca;
    }

    protected function setIt(string $it): static
    {
        Assertion::maxLength($it, 20, 'it value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->it = $it;

        return $this;
    }

    public function getIt(): string
    {
        return $this->it;
    }
}
