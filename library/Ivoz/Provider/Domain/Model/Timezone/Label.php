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
     * @var string
     */
    private $en = '';

    /**
     * column: timeZoneLabel_es
     * @var string
     */
    private $es = '';

    /**
     * column: timeZoneLabel_ca
     * @var string
     */
    private $ca = '';

    /**
     * column: timeZoneLabel_it
     * @var string
     */
    private $it = '';

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
