<?php

namespace Service\Behat;

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\MinkExtension\Context\RawMinkContext;
use Ivoz\Api\Behat\Context\FeatureContext as BaseFeatureContext;
use Symfony\Component\HttpKernel\KernelInterface;

class FeatureContext extends BaseFeatureContext
{
    private string $storagePath;

    public function __construct(
        KernelInterface $kernel
    ) {
        $container = $kernel->getContainer();
        /** @var string $storagePath */
        $storagePath = $container->getParameter('local_storage_path');
        $this->storagePath = $storagePath;

        if (substr($this->storagePath, -1) !== '/') {
            $this->storagePath .= '/';
        }

        parent::__construct($kernel);
    }

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
     * @Given I add Wholesale Company Authorization header
     */
    public function setWholesaleCompanyAuthorizationHeader(): void
    {
        $this->setAuthorizationHeader('test_wholesale_admin');
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
     * @Given storage file exists :filename
     */
    public function setFileExists(string $filename): void
    {
        $filePath = $this->storagePath . $filename;
        $dir = dirname($filePath);

        if (!file_exists($dir)) {
            mkdir(
                directory: $dir,
                recursive: true,
            );
        }

        file_put_contents(
            $filePath,
            'random data'
        );
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
