<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CompanyExtensionsAction
{
    protected $tokenStorage;
    protected $extensionRepository;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        ExtensionRepository $extensionRepository
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->extensionRepository = $extensionRepository;
    }

    public function __invoke()
    {
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var UserInterface $user */
        $user = $token->getUser();

        /** @var CompanyInterface $company */
        $company = $user->getCompany();

        return $this
            ->extensionRepository
            ->findByCompanyId($company->getId());
    }
}
