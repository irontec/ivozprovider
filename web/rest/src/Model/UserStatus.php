<?php

namespace Model;

use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
 * Class UserStatus
 * @package Model
 * @codeCoverageIgnore
 */
class UserStatus
{
    const VOICEMAIL_SERVICE_CODE = 'Voicemail';

    /**
     * @var string
     */
    protected $userName;

    protected $companyName;
    protected $companyDomain;
    protected $voiceMail;
    protected $gsQRCode;

    // kam_users_location
    protected $userAgent;
    protected $ipRegistered;

    // Terminal
    protected $statusTerminal;
    protected $terminalName;
    protected $terminalPassword;

    // Extension
    protected $extensionNumber;

    public static function fromUser(UserInterface $user)
    {
        $company = $user->getCompany();
        $terminal = $user->getTerminal();
        $extension = $user->getExtension();

        $self = new self();
        // User
        $self->setUserName(
            $user->getName()
            . ' '
            . $user->getLastname()
        );
        $self->setGsQRCode(
            $user->getGsQRCode()
        );

        if ($terminal) {
            $self
                ->setTerminalName(
                    $terminal->getName()
                )->setTerminalPassword(
                    $terminal->getPassword()
                );
        }

        if ($extension) {
            $self
                ->setExtensionNumber(
                    $extension->getNumber()
                );
        }

        if ($company) {
            $self->setCompanyName(
                $company->getName()
            )->setVoiceMail(
                $company->getServiceCode(self::VOICEMAIL_SERVICE_CODE)
            )->setCompanyDomain(
                $company->getDomainUsers()
            );
        }

        return $self;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     * @return UserStatus
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     * @return UserStatus
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompanyDomain()
    {
        return $this->companyDomain;
    }

    /**
     * @param mixed $companyDomain
     * @return UserStatus
     */
    public function setCompanyDomain($companyDomain)
    {
        $this->companyDomain = $companyDomain;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVoiceMail()
    {
        return $this->voiceMail;
    }

    /**
     * @param mixed $voiceMail
     * @return UserStatus
     */
    public function setVoiceMail($voiceMail)
    {
        $this->voiceMail = $voiceMail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGsQRCode()
    {
        return $this->gsQRCode;
    }

    /**
     * @param mixed $gsQRCode
     * @return UserStatus
     */
    public function setGsQRCode($gsQRCode)
    {
        $this->gsQRCode = $gsQRCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param mixed $userAgent
     * @return UserStatus
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpRegistered()
    {
        return $this->ipRegistered;
    }

    /**
     * @param mixed $ipRegistered
     * @return UserStatus
     */
    public function setIpRegistered($ipRegistered)
    {
        $this->ipRegistered = $ipRegistered;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusTerminal()
    {
        return $this->statusTerminal;
    }

    /**
     * @param mixed $statusTerminal
     * @return UserStatus
     */
    public function setStatusTerminal($statusTerminal)
    {
        $this->statusTerminal = $statusTerminal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTerminalName()
    {
        return $this->terminalName;
    }

    /**
     * @param mixed $terminalName
     * @return UserStatus
     */
    public function setTerminalName($terminalName)
    {
        $this->terminalName = $terminalName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTerminalPassword()
    {
        return $this->terminalPassword;
    }

    /**
     * @param mixed $terminalPassword
     * @return UserStatus
     */
    public function setTerminalPassword($terminalPassword)
    {
        $this->terminalPassword = $terminalPassword;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtensionNumber()
    {
        return $this->extensionNumber;
    }

    /**
     * @param mixed $extensionNumber
     * @return UserStatus
     */
    public function setExtensionNumber($extensionNumber)
    {
        $this->extensionNumber = $extensionNumber;
        return $this;
    }
}