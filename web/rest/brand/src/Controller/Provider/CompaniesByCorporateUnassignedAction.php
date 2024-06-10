<?php

namespace Controller\Provider;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Doctrine\DBAL\Driver\PDO\Exception;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\Friend\FriendRepository;
use Service\Application\Company\GetCompaniesByCorporateUnassigned;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CompaniesByCorporateUnassignedAction
{
    public function __construct(
        private GetCompaniesByCorporateUnassigned $getCompaniesByCorporateUnassigned,
        private TokenStorageInterface $tokenStorage
    ) {
    }

    /**
     * @return CompanyInterface[]
     */
    public function __invoke(Request $request): array
    {
        $includeId = (int) $request->query->get('_includeId', -1);
        $companyId = (int) $request->query->get('_companyId', -1);
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        return $this
            ->getCompaniesByCorporateUnassigned
            ->execute($companyId, $includeId);
    }
}
