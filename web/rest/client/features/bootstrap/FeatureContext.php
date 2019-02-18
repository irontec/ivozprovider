<?php

use Ivoz\Api\Behat\Context\FeatureContext as BaseFeatureContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends BaseFeatureContext
{
    /**
     * @Given I add Company Authorization header
     */
    public function setCompanyAuthorizationHeader()
    {
        return $this->setAuthorizationHeader('test_company_admin');
    }
}
