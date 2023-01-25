<?php

namespace Controller\Provider\Administrator;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Service\AdministratorRelPublicEntity\SwitchAcl;
use Swoole\Server\Admin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MassUpdateAclsAction
{
    public function __construct(
        private AdministratorRepository $administratorRepository,
        private CompanyRepository $companyRepository,
        private TokenStorageInterface $tokenStorage,
        private SwitchAcl $switchAcl
    ) {
    }

    public function __invoke(Request $request): Response
    {
        /** @var int[] $publicEntitiesRelUserIds */
        $publicEntitiesRelUserIds = $request->toArray();
        $adminId = (int) $request->attributes->get('id');
        $routeName = (string) $request->attributes->get('_route');

        $token = $this->tokenStorage->getToken();

        if (!$token) {
            throw new \DomainException('Token not valid', 403);
        }

        /** @var ?AdministratorInterface $administrator */
        $administrator = $this->administratorRepository->find($adminId);

        if (is_null($administrator)) {
            return new Response('Administrator not found', 404);
        }

        if (!$administrator->getRestricted()) {
            return new Response('Administrator user is not restricted', 403);
        }

        /** @var AdministratorInterface $apiAdmin */
        $apiAdmin = $token->getUser();

        if (is_null($apiAdmin->getBrand())) {
            throw new \DomainException('Brand admin required', 403);
        }

        if ($apiAdmin->getBrand() !== $administrator->getBrand()) {
            return new Response('You don\'t have access to this administrator', 403);
        }

        match (true) {
            $routeName === 'post_provider_administrator_grant_all' => $this
                ->switchAcl
                ->execute(
                    $adminId,
                    $publicEntitiesRelUserIds,
                    SwitchAcl::ACL_GRANT_ALL
                ),
            $routeName === 'post_provider_administrator_grant_read_only'  => $this
                ->switchAcl
                ->execute(
                    $adminId,
                    $publicEntitiesRelUserIds,
                    SwitchAcl::ACL_GRANT_READ_ONLY
                ),
            $routeName === 'post_provider_administrator_revoke_all' => $this
                ->switchAcl
                ->execute(
                    $adminId,
                    $publicEntitiesRelUserIds,
                    SwitchAcl::ACL_REVOKE_ALL
                ),
            default => throw new \UnhandledMatchError('No matching route found', 404),
        };

        $headers = [
            'Content-Type' => 'application/json'
        ];
        return new Response('{ status: OK }', 200, $headers);
    }
}
