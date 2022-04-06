<?php

namespace Service\Behat;

use Ivoz\Api\Behat\Context\FeatureContext as BaseFeatureContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\MinkExtension\Context\RawMinkContext;

class FeatureContext extends BaseFeatureContext
{
    /**
     * @Given I add Company Authorization header
     */
    public function setCompanyAuthorizationHeader(): void
    {
        $this->setAuthorizationHeader('test_company_admin');
    }

    /**
     * @Given I add restricted Company Authorization header
     */
    public function setRestrictedCompanyAuthorizationHeader(): void
    {
        $this->setAuthorizationHeader('restrictedCompanyAdmin');
    }


    /**
     * @Given I add Residential Company Authorization header
     */
    public function setResidentialCompanyAuthorizationHeader(): void
    {
        $this->setAuthorizationHeader('test_residential_admin');
    }

    /**
     * @Given I add Retail Company Authorization header
     */
    public function setRetailCompanyAuthorizationHeader(): void
    {
        $this->setAuthorizationHeader('test_retail_admin');
    }

    /**
     * @Given I exchange Client Authorization header
     */
    public function setBrandAuthorizationHeaderByExchange(): void
    {
        $this->exchangeAuthorizationHeader('test_brand_admin', 'test_company_admin');
    }

    /**
     * @Given I exchange internal Client Authorization header
     */
    public function setInternalBrandAuthorizationHeaderByExchange(): void
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
     *
     * @return void
     */
    public function setUserApiContext(BeforeScenarioScope $scope): void
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
