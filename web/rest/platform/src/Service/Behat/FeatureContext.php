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
