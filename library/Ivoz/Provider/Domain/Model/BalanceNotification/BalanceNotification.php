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
        /**
         * @todo ensure carrier or company to have value
         */
        if ($this->getCarrier()) {
            $this->setCompany(null);
        }
    }

    /**
     * @return LanguageInterface | null
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
        $language = $company
            ? $company->getLanguage()
            : null;

        if (!$language && $company) {

            /**
             * @todo remove this. Company will already have brand language
             * @see Company::sanitizeValues()
             */
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
