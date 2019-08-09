<?php

namespace Ivoz\Api\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Exception\ExpectationException;
use Behat\MinkExtension\Context\MinkAwareContext;
use Behat\MinkExtension\Context\RawMinkContext;
use Symfony\Component\Filesystem\Filesystem;
use Behatch\HttpCall\Request;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    protected static $tokenCache = [];

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
     * @When I send a :method multipart request to :url with body:
     */
    public function iSendAMultipartRequestTo($method, $url, PyStringNode $body = null, $files = [])
    {
        if ($body !== null) {
            $body = implode(
                "\r\n",
                $body->getStrings()
            );
        }

        return $this->request->send(
            $method,
            $this->locatePath($url),
            [],
            $files,
            $body
        );
    }

    /**
     * Checks, whether the response content is equal to given text
     *
     * @Then the streamed response should be equal to
     */
    public function theStreamedResponseShouldBeEqualTo(PyStringNode $expected)
    {
        $expected = str_replace('\\"', '"', $expected);
        $actual = $this->getStreamedResponseContent();
        $message = "the response was \n\"\"\"\n$actual\"\"\"";

        $this->assert(
            $expected == $actual,
            $message ?: "The element '$actual' is not equal to '$expected'"
        );
    }

    protected function getStreamedResponseContent()
    {
        $requestReflection = new \ReflectionClass($this->request);
        $minkPropertyAccessor = $requestReflection->getProperty('mink');
        $minkPropertyAccessor->setAccessible(true);

        $mink = $minkPropertyAccessor->getValue($this->request);
        $response = $mink->getSession()->getDriver()->getClient()->getResponse();

        if (!$response instanceof StreamedResponse) {
            throw new \Exception('StreamedResponse was expected');
        }

        $responseReflection = new \ReflectionClass($response);
        $streamedPropertyAccessor = $responseReflection->getProperty('streamed');
        $streamedPropertyAccessor->setAccessible(true);
        $streamedPropertyAccessor->setValue($response, false);

        ob_start();
        $response->sendContent();
        $responseContent = ob_get_clean();

        return $responseContent;
    }

    protected function assert($test, $message)
    {
        if ($test === false) {
            throw new ExpectationException($message, $this->getSession()->getDriver());
        }
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
        $cacheKey = $endpoint . '/' . $username;
        if (array_key_exists($cacheKey, self::$tokenCache)) {
            return self::$tokenCache[$cacheKey];
        }

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

        self::$tokenCache[$cacheKey] = $data->token ?? null;

        return self::$tokenCache[$cacheKey];
    }
}
