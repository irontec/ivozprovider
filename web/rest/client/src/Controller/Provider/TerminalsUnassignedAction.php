<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;
use Ivoz\Provider\Domain\Model\Terminal\TerminalRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class TerminalsUnassignedAction
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private TerminalRepository $terminalRepository,
        private RequestStack $requestStack,
        private DenormalizerInterface $denormalizer
    ) {
    }

    /**
     * @return array<int, mixed>
     * @throws ResourceClassNotFoundException
     */
    public function __invoke(): array
    {
        /** @var Request $request */
        $request = $this->requestStack->getCurrentRequest();
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var AdministratorInterface $admin */
        $admin = $token->getUser();
        /** @var CompanyInterface $company */
        $company = $admin->getCompany();

        $includeId = (int) $request->query->get('_includeId');
        $includeIds = $includeId
            ? [$includeId]
            : [];

        $terminals = $this->terminalRepository->findUnassignedByCompanyId(
            (int) $company->getId(),
            $includeIds
        );

        $response = [];
        foreach ($terminals as $terminal) {
            $response[] = $this->denormalizer->denormalize(
                [],
                Terminal::class,
                $request->getRequestFormat(),
                [
                    'object_to_populate' => $terminal,
                    'operation_normalization_context' => TerminalDto::CONTEXT_COLLECTION
                ]
            );
        }

        return $response;
    }
}
