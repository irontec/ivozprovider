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
    public function __construct(
        private RequestStack $requestStack,
        private ExchangeToken $exchangeToken
    ) {
    }

    /**
     * @return Response|Token
     *
     * @throws ResourceClassNotFoundException
     */
    public function __invoke(): Response|Token
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

    private function run(): Token
    {
        /** @var Request $request */
        $request = $this->requestStack->getCurrentRequest();

        /** @var ?string  $inputToken */
        $inputToken =  $request->get('token', null);
        if (is_null($inputToken)) {
            throw new \DomainException(
                'Token not found'
            );
        }

        /** @var ?string $username */
        $username = $request->get('username');

        /** @var ?int  $brandId */
        $brandId = $request->get('brandId', null);

        if (!$username && !$brandId) {
            throw new \DomainException(
                'Either username or brandId must be set'
            );
        }

        /** @var string $identity */
        $identity = $brandId
            ? '__b' . $brandId . '_internal'
            : $username;

        $tokenStr = $this->exchangeToken->execute(
            $inputToken,
            $identity
        );

        return new Token($tokenStr);
    }
}
