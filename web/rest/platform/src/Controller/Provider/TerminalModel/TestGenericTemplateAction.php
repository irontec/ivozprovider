<?php

namespace Controller\Provider\TerminalModel;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelRepository;
use Ivoz\Provider\Domain\Service\Terminal\Provision\ProvisionGeneric;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TestGenericTemplateAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private TerminalModelRepository $terminalModelRepository,
        private ProvisionGeneric $genericProvision,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $token = $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        $id = (int) $request->attributes->get('id');

        /** @var TerminalModelInterface | null $terminalModel */
        $terminalModel = $this->terminalModelRepository->find($id);

        if (!$terminalModel) {
            throw new NotFoundHttpException('Terminal model not found');
        }

        $response = $this
            ->genericProvision
            ->execute(
                $terminalModel
            );

        return new Response(
            content: $response,
            headers: [
                'Content-Type' => 'text/plain',
            ]
        );
    }
}
