<?php

namespace Controller\Provider\TerminalModel;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelRepository;
use Ivoz\Provider\Domain\Service\Terminal\Provision\ProvisionSpecific;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TestSpecificTemplateAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private TerminalModelRepository $terminalModelRepository,
        private ProvisionSpecific $specificProvision,
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
            ->specificProvision
            ->execute(
                (string) $request->query->get('mac'),
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
