<?php

namespace Controller\Auth;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Api\Operation\ExchangeToken;
use Model\Token;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenExchangeAction
{
    public function __construct(
        private ExchangeToken $exchangeToken
    ) {
    }

    /**
     * @return Response|Token
     *
     * @throws ResourceClassNotFoundException
     */
    public function __invoke(Request $request): Response|Token
    {
        try {
            return $this->run($request);
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
                (int) $code
            );
        }
    }

    private function run(Request $request): Token
    {
        /** @var ?string  $inputToken */
        $inputToken =  $request->request->get('token', null);
        if (is_null($inputToken)) {
            throw new \DomainException(
                'Token not found'
            );
        }

        /** @var ?string $username */
        $username = $request->request->get('username', null);

        if (!$username) {
            throw new \DomainException(
                'Either username or clientId must be set'
            );
        }

        $tokenStr = $this->exchangeToken->execute(
            $inputToken,
            $username
        );

        return new Token($tokenStr);
    }
}
