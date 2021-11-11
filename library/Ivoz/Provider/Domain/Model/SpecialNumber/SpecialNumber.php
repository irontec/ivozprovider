<?php

namespace Ivoz\Provider\Domain\Model\SpecialNumber;

/**
 * SpecialNumber
 */
class SpecialNumber extends SpecialNumberAbstract implements SpecialNumberInterface
{
    use SpecialNumberTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    protected function sanitizeValues(): void
    {
        $notNew = !$this->isNew();
        $brandHasChanged = $this->hasChanged('brandId');

        if ($notNew && $brandHasChanged) {
            $errorMsg = $this->getBrand()
                ? 'Unable to convert a global special number into a brand special number'
                : 'Unable to convert a brand special number into a global special number';

            throw new \DomainException($errorMsg);
        }

        $country = $this->getCountry();

        $this->setNumberE164(
            $country->getCountryCode()
            . $this->getNumber()
        );
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
