<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Symfony\Component\Filesystem\Filesystem;
use Behatch\HttpCall\Request;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    protected $cacheDir;

    /**
     * @var Filesystem
     */
    protected $fs;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(\AppKernel $kernel, Request $request)
    {
        $this->cacheDir = $kernel->getCacheDir();
        $this->fs = new Filesystem();
        $this->request = $request;
    }

    /**
     * @Given I add Company Authorization header
     */
    public function setAuthorizationHeader()
    {
        $response = $this->request->send(
            'POST',
            'admin_login',
            [
                'username' => 'test_company_admin',
                'password' => 'changeme'
            ]
        );

        $data = json_decode($response->getContent());

        if (!$data) {
            throw new \Exception('Could not retrieve a token');
        }

        $this->request->setHttpHeader('Authorization', 'Bearer ' . ($data->token ?? null));
    }

    /**
     * @BeforeScenario @createSchema
     */
    public function resetDatabase()
    {
        $this->dropDatabase();
        $this->fs->copy(
            $this->cacheDir . DIRECTORY_SEPARATOR . 'db.sqlite.back',
            $this->cacheDir . DIRECTORY_SEPARATOR . '/db.sqlite'
        );
    }

    /**
     * @AfterScenario @dropSchema
     */
    public function dropDatabase()
    {
        $this->fs->remove(
            $this->cacheDir . DIRECTORY_SEPARATOR . 'db.sqlite'
        );
    }
}