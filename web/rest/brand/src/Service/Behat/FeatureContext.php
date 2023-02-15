<?php

namespace Service\Behat;

use Ivoz\Api\Behat\Context\FeatureContext as BaseFeatureContext;

class FeatureContext extends BaseFeatureContext
{
    /**
     * @Given I add Brand Authorization header
     *
     * @return void
     */
    public function setBrandAuthorizationHeader(): void
    {
        $this->setAuthorizationHeader('test_brand_admin');
    }

    /**
     * @Given I exchange Brand Authorization header
     *
     * @return void
     */
    public function setBrandAuthorizationHeaderByExchange(): void
    {
        $this->exchangeAuthorizationHeader('admin', 'test_brand_admin');
    }

    /**
     * @Given I exchange internal Brand Authorization header
     *
     * @return void
     */
    public function setInternalBrandAuthorizationHeaderByExchange(): void
    {
        $this->exchangeAuthorizationHeader('admin', '__b1_internal');
    }

    /**
     * @Given I add restricted Brand Authorization header
     */
    public function iAddRestrictedBrandAuthorizationHeader(): void
    {
        $this->setAuthorizationHeader('restrictedBrandAdmin');
    }
}
