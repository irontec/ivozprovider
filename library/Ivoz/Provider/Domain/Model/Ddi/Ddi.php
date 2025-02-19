<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

use Assert\Assertion;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Traits\RoutableTrait;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;

/**
 * Ddi
 */
class Ddi extends DdiAbstract implements DdiInterface
{
    use DdiTrait;
    use RoutableTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
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

    /**
     * Return string representation of this entity
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "%s [%s]",
            $this->getDdie164(),
            parent::__toString()
        );
    }

    protected function sanitizeValues(): void
    {
        $changedClient = $this->hasChanged('companyId');
        $initialClient = $this->getInitialValue('companyId');

        if ($changedClient && $initialClient !== null) {
            throw new \DomainException(
                'Forbidden ddi client update',
                403
            );
        }

        $company = $this->getCompany();
        if (! $this->getCountry() && $company) {
            $this->setCountry(
                $company->getCountry()
            );
        }
        $country = $this->getCountry();

        $this->setDdie164(
            $country->getCountryCode()
            . $this->getDdi()
        );

        if ($this->getType() === DdiInterface::TYPE_OUT) {
            $this->setDdiProvider(null);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setDdi(string $ddi): static
    {
        Assertion::regex($ddi, '/^[0-9]+$/');
        return parent::setDdi($ddi);
    }

    public function getDomain(): ?DomainInterface
    {
        $company = $this->getCompany();

        if (!$company) {
            return null;
        }

        $brand = $company->getBrand();

        return $brand->getDomain();
    }

    public function getLanguageCode(): string
    {
        $language = $this->getLanguage();

        if (!$language) {
            $company = $this->getCompany();

            return $company
                ? $company->getLanguageCode()
                : $this->getBrand()->getLanguage()->getIden();
        }

        return $language->getIden();
    }

    public function setRouteType(?string $routeType = null): static
    {
        parent::setRouteType($routeType);

        $nullableFields = array(
            'user'          => 'user',
            'ivr'           => 'ivr',
            'huntGroup'     => 'huntGroup',
            'fax'           => 'fax',
            'friend'        => 'friendValue',
            'conferenceRoom' => 'conferenceRoom',
            'queue'         => 'queue',
        );

        foreach ($nullableFields as $type => $fieldName) {
            if ($routeType == $type) {
                continue;
            }

            $setter = 'set' . ucfirst($fieldName);
            $this->{$setter}(null);
        }

        return $this;
    }

    public function setUser(?UserInterface $user = null): static
    {
        return parent::setUser($user);
    }

    /**
     * @return string
     */
    public function getDdie164(): string
    {
        return
            $this->getCountry()->getCountryCode() .
            $this->getDdi();
    }
}
