<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;

/**
 * BalanceNotification
 */
class BalanceNotification extends BalanceNotificationAbstract implements BalanceNotificationInterface
{
    use BalanceNotificationTrait;

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

    protected function sanitizeValues(): void
    {
        /**
         * @todo ensure carrier or company to have value
         */
        if (
            !$this->getCarrier()
            && !$this->getCompany()
        ) {
            throw new \DomainException(
                'Either company or carrier is required'
            );
        }

        if ($this->getCarrier()) {
            $this->setCompany(null);
        }
    }

    public function getLanguage(): LanguageInterface
    {
        $carrier = $this->getCarrier();
        if ($carrier) {
            return $carrier
                ->getBrand()
                ->getLanguage();
        }

        /**
         * @see BalanceNotification::sanitizeValues
         * @var CompanyInterface $company
         */
        $company = $this->getCompany();

        return $company->getLanguage();
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
        $carrier = $this->getCarrier();
        if ($carrier) {
            return $carrier->getName();
        }

        return $this
            ->getCompany()
            ->getName();
    }
}
