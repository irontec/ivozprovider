<?php

use Ivoz\Api\Behat\Context\FeatureContext as BaseFeatureContext;

class FeatureContext extends BaseFeatureContext
{
    /**
     * @Given I add Brand Authorization header
     */
    public function setBrandAuthorizationHeader()
    {
        $this->setAuthorizationHeader('test_brand_admin');
    }
}
