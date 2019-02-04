<?php

namespace Model;

use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Api\Core\Annotation\AttributeDefinition;

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
     * @AttributeDefinition(type="string")
     */
    protected $userName;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $companyName;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $companyDomain;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $language;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $voiceMail;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $gsQRCode;

    // kam_users_location

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $userAgent;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $ipRegistered;

    // Terminal

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $statusTerminal;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $terminalName;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $terminalPassword;

    // Extension
    /**
     * @var int
     * @AttributeDefinition(type="int")
     */
    protected $extensionNumber;

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
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function setLanguage($language)
    {
        $this->language = $language;
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
