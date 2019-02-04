<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CompanyExtensionsAction
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    /**
     * @var CallForwardSettingRepository
     */
    protected $callForwardSettingRepository;

    public function __construct(
        TokenStorage $tokenStorage,
        ExtensionRepository $extensionRepository
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->extensionRepository = $extensionRepository;
    }

    public function __invoke()
    {
        /** @var TokenInterface $token */
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var CompanyInterface $company */
        $company = $token->getUser()->getCompany();
        return $this
            ->extensionRepository
            ->findByCompanyId($company->getId());
    }
}
