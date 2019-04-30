<?php

namespace Ivoz\Api\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behatch\HttpCall\HttpCallResultPool;
use Behatch\HttpCall\Request;
use Behatch\Context\BaseContext;
use Behatch\Json\Json;

/**
 * Defines application features from the specific context.
 */
class JsonContext extends BaseContext implements Context, SnippetAcceptingContext
{
    /**
     * @var Request
     */
    protected $request;

    protected $httpCallResultPool;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(
        Request $request,
        HttpCallResultPool $httpCallResultPool
    ) {
        $this->request = $request;
        $this->httpCallResultPool = $httpCallResultPool;
    }

    /**
     * @Then the JSON should be like:
     */
    public function theJsonShouldBeLike(PyStringNode $content)
    {
        $actual = new Json($this->httpCallResultPool->getResult()->getValue());

        try {
            $expected = new Json($content);
        } catch (\Exception $e) {
            throw new \Exception('The expected JSON is not a valid');
        }

        try {
            $this->assertAlike(
                $expected->getContent(),
                $actual->getContent()
            );
        } catch (\Exception $e) {
            $this->assert(
                false,
                "The json is equal to:\n". $actual->encode()
            );
        }
    }

    /**
     * @param mixed $expected
     * @param mixed $actual
     *
     * @return void
     */
    private function assertAlike($expected, $actual)
    {
        if ($expected instanceof \stdClass) {
            $expected = get_object_vars($expected);
            $actual = get_object_vars($actual);
        }

        if (is_array($expected)) {
            $keyDivergence = array_diff(
                array_keys($expected),
                array_keys($actual)
            );

            if (!empty($keyDivergence)) {
                $this->assert(
                    false,
                    "Object attributes are not equal: " . implode(', ', $keyDivergence)
                );
            }

            foreach ($expected as $key => $value) {
                if (!array_key_exists($key, $actual)) {
                    $this->assert(
                        false,
                        "Unable to find key $key in " . json_encode($actual)
                    );
                }

                $this->assertAlike($expected[$key], $actual[$key]);
            }

            return;
        }

        if ($expected !== '~') {
            $this->assert(
                $expected === $actual,
                "The element '$actual' is not equal to '$expected'"
            );

            return;
        }

        if (!($actual instanceof \stdClass)) {
            $this->assert(
                false,
                "Expected $actual to be an array"
            );
        }
    }
}
