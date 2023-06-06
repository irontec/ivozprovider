<?php

namespace Service\Behat;

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
