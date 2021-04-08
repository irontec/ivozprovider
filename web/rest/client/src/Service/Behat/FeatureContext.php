<?php

namespace Service\Behat;

use Ivoz\Api\Behat\Context\FeatureContext as BaseFeatureContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use \Behat\MinkExtension\Context\RawMinkContext;

class FeatureContext extends BaseFeatureContext
{
    /**
     * @Given I add Company Authorization header
     */
    public function setCompanyAuthorizationHeader()
    {
        return $this->setAuthorizationHeader('test_company_admin');
    }

    /**
     * @Given I add Residential Company Authorization header
     */
    public function setResidentialCompanyAuthorizationHeader()
    {
        return $this->setAuthorizationHeader('test_residential_admin');
    }

    /**
     * @Given I add Retail Company Authorization header
     */
    public function setRetailCompanyAuthorizationHeader()
    {
        return $this->setAuthorizationHeader('test_retail_admin');
    }

    /**
     * @Given I exchange Client Authorization header
     */
    public function setBrandAuthorizationHeaderByExchange()
    {
        $this->exchangeAuthorizationHeader('test_brand_admin', 'test_company_admin');
    }

    /**
     * @Given I add User Authorization header
     */
    public function setUserAuthorizationHeader()
    {
        return $this->setAuthorizationHeader('alice@democompany.com', 'user_login');
    }

    /**
     * @BeforeScenario @userApiContext
     */
    public function setUserApiContext(BeforeScenarioScope $scope)
    {
        /** @var \FriendsOfBehat\SymfonyExtension\Context\Environment\InitializedSymfonyExtensionEnvironment $environment */
        $environment = $scope->getEnvironment();

        foreach ($environment->getContextClasses() as $contextName) {
            $context = $environment->getContext($contextName);

            if ($context instanceof RawMinkContext) {
                $context->setMinkParameter(
                    'base_url',
                    'https://users-ivozprovider.irontec.com'
                );
            }
        }
    }
}
