<?php

namespace Service\Behat;

use Ivoz\Api\Behat\Context\FeatureContext as BaseFeatureContext;

class FeatureContext extends BaseFeatureContext
{
    /**
     * @Given I add Platform Authorization header
     */
    public function iAddPlatformAuthorizationHeader(): void
    {
        $this->setAuthorizationHeader('admin');
    }


    /**
     * @Given I add restricted Platform Authorization header
     */
    public function iAddRestrictedPlatformAuthorizationHeader(): void
    {
        $this->setAuthorizationHeader('utcAdmin');
    }
}
