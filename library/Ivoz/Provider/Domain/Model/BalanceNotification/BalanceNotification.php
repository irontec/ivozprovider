<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Ivoz\Provider\Domain\Model\Language\LanguageInterface;

/**
 * BalanceNotification
 */
class BalanceNotification extends BalanceNotificationAbstract implements BalanceNotificationInterface
{
    use BalanceNotificationTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    protected function sanitizeValues()
    {
        if ($this->getCarrier()) {
            $this->setCompany(null);
        }

        if ($this->getCompany()) {
            $this->setCarrier(null);
        }
    }

    /**
     * @return LanguageInterface
     */
    public function getLanguage()
    {
        $carrier = $this->getCarrier();
        if ($carrier) {
            return $carrier
                ->getBrand()
                ->getLanguage();
        }

        $company = $this->getCompany();
        $language = $company->getLanguage();
        if (!$language) {
            $language = $company
                ->getBrand()
                ->getLanguage();
        }

        return $language;
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
