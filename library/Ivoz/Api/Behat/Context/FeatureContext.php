<?php

namespace Ivoz\Api\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkAwareContext;
use Behat\MinkExtension\Context\RawMinkContext;
use Symfony\Component\Filesystem\Filesystem;
use Behatch\HttpCall\Request;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawMinkContext implements Context, SnippetAcceptingContext
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
     * @var JWTTokenManagerInterface
     */
    protected $jwtTokenManager;
    protected $administratorRepository;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(
        \AppKernel $kernel,
        Request $request
    ) {
        $this->cacheDir = $kernel->getCacheDir();
        $this->fs = new Filesystem();
        $this->request = $request;
        $this->jwtTokenManager = $kernel->getContainer()->get('lexik_jwt_authentication.jwt_manager.public');
        $this->administratorRepository = $kernel->getContainer()->get(
            AdministratorRepository::class
        );
    }

    /**
     * @Given I add Authorization header for :username
     */
    public function setAuthorizationHeaderFor($username)
    {
        self::setAuthorizationHeader($username);
    }

    /**
     * @Given I add Authorization header
     */
    public function setAuthorizationHeader($username = 'admin', string $endpoint = 'admin_login')
    {
        $token = $this->sendLoginRequest(
            $username,
            $endpoint
        );

        $this->request->setHttpHeader('Authorization', 'Bearer ' . $token);
    }

    /**
     * @param string $baseUsername
     * @param string $username
     */
    protected function exchangeAuthorizationHeader(string $baseUsername, string $username)
    {
        $baseAdmin = $this->administratorRepository->findOneBy([
            'username' => $baseUsername
        ]);
        $token = $this->jwtTokenManager->create(
            $baseAdmin
        );

        $this->request->setHttpHeader(
            'accept',
            'application/json'
        );

        $response = $this->request->send(
            'POST',
            $this->locatePath('/token/exchange'),
            [
                'token' => $token,
                'username' => $username
            ]
        );

        $data = json_decode(
            $response->getContent()
        );
        $token = $data->token ?? null;

        if (!$data) {
            throw new \Exception('Could not exchange a token');
        }

        $this->request->setHttpHeader('Authorization', 'Bearer ' . $token);
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

    /**
     * @param $username
     * @return string | null
     * @throws \Exception
     */
    private function sendLoginRequest($username, string $endpoint)
    {
        $userFld = $endpoint === 'admin_login'
            ? 'username'
            : 'email';

        $response = $this->request->send(
            'POST',
            $this->locatePath($endpoint),
            [
                $userFld => $username,
                'password' => 'changeme'
            ]
        );

        $data = json_decode($response->getContent());

        if (!$data) {
            throw new \Exception('Could not retrieve a token');
        }

        return $data->token ?? null;
    }
}
