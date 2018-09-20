<?php

namespace Controller\My;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationInterface;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Model\UserStatus;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class StatusAction
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    /**
     * @var UsersLocationRepository
     */
    protected $usersLocationRepository;

    public function __construct (
        TokenStorage $tokenStorage,
        UsersLocationRepository $usersLocationRepository
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->usersLocationRepository = $usersLocationRepository;
    }

    public function __invoke()
    {
        /** @var TokenInterface $token */
        $token =  $this->tokenStorage->getToken();

        if (!$token || !$token->getUser()) {
            throw new ResourceClassNotFoundException('User not found');
        }

        /** @var UserInterface $user */
        $user = $token->getUser();
        $company = $user->getCompany();
        $terminal = $user->getTerminal();
        $userLocation = null;
        if ($terminal) {
            $userLocation  = $this->usersLocationRepository->findOneBy([
                'username' => $terminal->getName(),
                'domain' => $company->getDomain()->getDomain()
            ]);
        }
        $extension = $user->getExtension();

        $userStatus = new UserStatus();
        $userStatus->setUserName(
            $user->getFullName()
        );
        $userStatus->setLanguage(
            $user->getLanguageCode()
        );
        $userStatus->setGsQRCode(
            $user->getGsQRCode()
        );

        if ($terminal) {
            $this->setTerminalData($userStatus, $terminal);
        }

        if ($userLocation) {
            $this->setUserLocationData($userLocation, $userStatus);
        }

        if ($extension) {
            $this->setExtensionData($userStatus, $extension);
        }

        if ($company) {
            $this->setCompanyData($userStatus, $company);
        }

        return $userStatus;
    }

    /**
     * @param $userStatus
     * @param $terminal
     */
    private function setTerminalData(UserStatus $userStatus, TerminalInterface $terminal)
    {
        $userStatus
            ->setTerminalName(
                $terminal->getName()
            )->setTerminalPassword(
                $terminal->getPassword()
            );
    }

    /**
     * @param $userLocation
     * @param $userStatus
     */
    private function setUserLocationData(UsersLocationInterface $userLocation, UserStatus $userStatus)
    {
        $contact = $userLocation->getContact();
        $ip = explode(';', $contact);

        $userStatus
            ->setStatusTerminal(true)
            ->setIpRegistered($ip[0])
            ->setUserAgent($userLocation->getUserAgent());
    }

    /**
     * @param $userStatus
     * @param $extension
     */
    private function setExtensionData(UserStatus $userStatus, ExtensionInterface $extension)
    {
        $userStatus
            ->setExtensionNumber(
                $extension->getNumber()
            );
    }

    /**
     * @param $userStatus
     * @param $company
     */
    private function setCompanyData(UserStatus $userStatus, CompanyInterface $company)
    {
        $userStatus->setCompanyName(
            $company->getName()
        )->setVoiceMail(
            $company->getServiceCode(UserStatus::VOICEMAIL_SERVICE_CODE)
        )->setCompanyDomain(
            $company->getDomainUsers()
        );
    }
}