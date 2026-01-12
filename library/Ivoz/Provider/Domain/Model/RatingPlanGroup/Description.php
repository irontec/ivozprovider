<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\RatingPlanGroup;

use Assert\Assertion;

/**
* Description
* @codeCoverageIgnore
*/
final class Description
{
    /**
     * @var string
     * column: description_en
     */
    private $en;

    /**
     * @var string
     * column: description_es
     */
    private $es;

    /**
     * @var string
     * column: description_ca
     */
    private $ca;

    /**
     * @var string
     * column: description_it
     */
    private $it;

    /**
     * @var string
     * column: description_eu
     */
    private $eu;

    /**
     * Constructor
     */
    public function __construct(
        string $en,
        string $es,
        string $ca,
        string $it,
        string $eu
    ) {
        $this->setEn($en);
        $this->setEs($es);
        $this->setCa($ca);
        $this->setIt($it);
        $this->setEu($eu);
    }

    public function equals(self $description): bool
    {
        if ($this->getEn() !== $description->getEn()) {
            return false;
        }
        if ($this->getEs() !== $description->getEs()) {
            return false;
        }
        if ($this->getCa() !== $description->getCa()) {
            return false;
        }
        if ($this->getIt() !== $description->getIt()) {
            return false;
        }
        return $this->getEu() === $description->getEu();
    }

    protected function setEn(string $en): static
    {
        Assertion::maxLength($en, 255, 'en value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->en = $en;

        return $this;
    }

    public function getEn(): string
    {
        return $this->en;
    }

    protected function setEs(string $es): static
    {
        Assertion::maxLength($es, 255, 'es value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->es = $es;

        return $this;
    }

    public function getEs(): string
    {
        return $this->es;
    }

    protected function setCa(string $ca): static
    {
        Assertion::maxLength($ca, 255, 'ca value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ca = $ca;

        return $this;
    }

    public function getCa(): string
    {
        return $this->ca;
    }

    protected function setIt(string $it): static
    {
        Assertion::maxLength($it, 255, 'it value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->it = $it;

        return $this;
    }

    public function getIt(): string
    {
        return $this->it;
    }

    protected function setEu(string $eu): static
    {
        Assertion::maxLength($eu, 255, 'eu value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->eu = $eu;

        return $this;
    }

    public function getEu(): string
    {
        return $this->eu;
    }
}
