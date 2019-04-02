<?php

namespace Controller\Auth;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Api\Operation\ExchangeToken;
use Model\Token;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class TokenExchangeAction
{
    private $requestStack;
    private $exchangeToken;

    public function __construct(
        RequestStack $requestStack,
        ExchangeToken $exchangeToken
    ) {
        $this->requestStack = $requestStack;
        $this->exchangeToken = $exchangeToken;
    }

    /**
     * @return Response
     * @throws ResourceClassNotFoundException
     */
    public function __invoke()
    {
        try {
            return $this->run();
        } catch (\Exception $e) {
            $code = $e->getCode();
            if ($code < 400) {
                $code = 500;
            }

            $message = sprintf(
                '{"code": %d, "message": "%s"}',
                $code,
                $e->getMessage()
            );

            return new Response(
                $message,
                $code
            );
        }
    }

    private function run()
    {
        /** @var Request $request */
        $request = $this->requestStack->getCurrentRequest();

        /** @var string  $inputToken */
        $inputToken =  $request->get('token');
        /** @var int $username */
        $username = $request->get('username');

        $tokenStr = $this->exchangeToken->execute(
            $inputToken,
            $username
        );

        return new Token($tokenStr);
    }
}
