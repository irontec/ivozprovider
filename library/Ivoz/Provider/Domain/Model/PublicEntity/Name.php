<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\PublicEntity;

use Assert\Assertion;

/**
* Name
* @codeCoverageIgnore
*/
class Name
{
    /**
     * column: name_en
     * @var string | null
     */
    protected $en;

    /**
     * column: name_es
     * @var string | null
     */
    protected $es;

    /**
     * column: name_ca
     * @var string | null
     */
    protected $ca;

    /**
     * column: name_it
     * @var string | null
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

    protected function setEn(?string $en = null): static
    {
        if (!is_null($en)) {
            Assertion::maxLength($en, 100, 'en value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->en = $en;

        return $this;
    }

    public function getEn(): ?string
    {
        return $this->en;
    }

    protected function setEs(?string $es = null): static
    {
        if (!is_null($es)) {
            Assertion::maxLength($es, 100, 'es value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->es = $es;

        return $this;
    }

    public function getEs(): ?string
    {
        return $this->es;
    }

    protected function setCa(?string $ca = null): static
    {
        if (!is_null($ca)) {
            Assertion::maxLength($ca, 100, 'ca value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ca = $ca;

        return $this;
    }

    public function getCa(): ?string
    {
        return $this->ca;
    }

    protected function setIt(?string $it = null): static
    {
        if (!is_null($it)) {
            Assertion::maxLength($it, 100, 'it value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->it = $it;

        return $this;
    }

    public function getIt(): ?string
    {
        return $this->it;
    }

}
