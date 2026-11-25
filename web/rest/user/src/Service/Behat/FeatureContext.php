<?php

namespace Service\Behat;

use Ivoz\Api\Behat\Context\FeatureContext as BaseFeatureContext;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\MinkExtension\Context\RawMinkContext;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\User\User;
use Symfony\Component\HttpKernel\KernelInterface;

class FeatureContext extends BaseFeatureContext
{
    private string $storagePath;

    private ObjectRepository $userRepository;

    public function __construct(
        KernelInterface $kernel
    ) {
        $container = $kernel->getContainer();
        /** @var ManagerRegistry $doctrine */
        $doctrine = $container->get('doctrine');
        $this->userRepository = $doctrine->getRepository(User::class);
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
     * @Given I exchange User Authorization header
     *
     * @return void
     */
    public function setUserAuthorizationHeaderByExchange(): void
    {
        $this->exchangeAuthorizationHeader('test_company_admin', 'alice@democompany.com');
    }

    /**
     * @Given I add User Authorization header
     */
    public function setUserAuthorizationHeader()
    {
        return $this->setAuthorizationHeader('alice@democompany.com', 'user_login');
    }

    /**
     * @Given I add User Authorization header for :email
     */
    public function setUserAuthorizationHeaderFor(string $email): void
    {
        /** @var User $user */
        $user = $this->userRepository->findOneBy([
            'email' => $email
        ]);
        $token = $this->jwtTokenManager->create($user);

        $this->request->setHttpHeader('Authorization', 'Bearer ' . $token);
    }

    /**
     * @Given I exchange User Authorization header for :email
     */
    public function setUserAuthorizationHeaderByExchangeFor(string $email): void
    {
        $this->exchangeAuthorizationHeader('test_company_admin', $email);
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
}
