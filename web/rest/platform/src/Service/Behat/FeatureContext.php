<?php

namespace Service\Behat;

use Behat\Gherkin\Node\PyStringNode;
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

    /**
     * @Given :file exists with the content of :source
     */
    public function copyFileInStorage(string $dst, string $source): void
    {
        $dir = dirname($dst);

        if (!file_exists($dir)) {
            mkdir(
                directory: $dir,
                recursive: true,
            );
        }

        copy(
            $source,
            $dst
        );
    }

    /**
     * Sends a HTTP request
     *
     * @param array<string> $files
     *
     * @Given I send a :method request to :url under :domain
     * @return \Behat\Mink\Element\DocumentElement
     */
    public function iSendARequestToDomain(string $method, string $url, string $domain, PyStringNode $body = null, $files = [])
    {
        $this->setMinkParameter('base_url', $domain);

        /** @var \Behatch\HttpCall\Request\BrowserKit $request */
        $request = $this->request;

        return $request->send(
            $method,
            $this->locatePath($url),
            [],
            $files,
            $body !== null ? $body->getRaw() : null
        );
    }
}
