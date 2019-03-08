<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderRegistration;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class DdiProviderRegistrationDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $username = '';

    /**
     * @var string
     */
    private $domain = '';

    /**
     * @var string
     */
    private $realm = '';

    /**
     * @var string
     */
    private $authUsername = '';

    /**
     * @var string
     */
    private $authPassword = '';

    /**
     * @var string
     */
    private $authProxy = '';

    /**
     * @var integer
     */
    private $expires = 0;

    /**
     * @var boolean
     */
    private $multiDdi = '0';

    /**
     * @var string
     */
    private $contactUsername = '';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto | null
     */
    private $trunksUacreg;

    /**
     * @var \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto | null
     */
    private $ddiProvider;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'username' => 'username',
            'domain' => 'domain',
            'realm' => 'realm',
            'authUsername' => 'authUsername',
            'authPassword' => 'authPassword',
            'authProxy' => 'authProxy',
            'expires' => 'expires',
            'multiDdi' => 'multiDdi',
            'contactUsername' => 'contactUsername',
            'id' => 'id',
            'trunksUacregId' => 'trunksUacreg',
            'ddiProviderId' => 'ddiProvider'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'username' => $this->getUsername(),
            'domain' => $this->getDomain(),
            'realm' => $this->getRealm(),
            'authUsername' => $this->getAuthUsername(),
            'authPassword' => $this->getAuthPassword(),
            'authProxy' => $this->getAuthProxy(),
            'expires' => $this->getExpires(),
            'multiDdi' => $this->getMultiDdi(),
            'contactUsername' => $this->getContactUsername(),
            'id' => $this->getId(),
            'trunksUacreg' => $this->getTrunksUacreg(),
            'ddiProvider' => $this->getDdiProvider()
        ];
    }

    /**
     * @param string $username
     *
     * @return static
     */
    public function setUsername($username = null)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $domain
     *
     * @return static
     */
    public function setDomain($domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $realm
     *
     * @return static
     */
    public function setRealm($realm = null)
    {
        $this->realm = $realm;

        return $this;
    }

    /**
     * @return string
     */
    public function getRealm()
    {
        return $this->realm;
    }

    /**
     * @param string $authUsername
     *
     * @return static
     */
    public function setAuthUsername($authUsername = null)
    {
        $this->authUsername = $authUsername;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthUsername()
    {
        return $this->authUsername;
    }

    /**
     * @param string $authPassword
     *
     * @return static
     */
    public function setAuthPassword($authPassword = null)
    {
        $this->authPassword = $authPassword;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->authPassword;
    }

    /**
     * @param string $authProxy
     *
     * @return static
     */
    public function setAuthProxy($authProxy = null)
    {
        $this->authProxy = $authProxy;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthProxy()
    {
        return $this->authProxy;
    }

    /**
     * @param integer $expires
     *
     * @return static
     */
    public function setExpires($expires = null)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * @return integer
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param boolean $multiDdi
     *
     * @return static
     */
    public function setMultiDdi($multiDdi = null)
    {
        $this->multiDdi = $multiDdi;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getMultiDdi()
    {
        return $this->multiDdi;
    }

    /**
     * @param string $contactUsername
     *
     * @return static
     */
    public function setContactUsername($contactUsername = null)
    {
        $this->contactUsername = $contactUsername;

        return $this;
    }

    /**
     * @return string
     */
    public function getContactUsername()
    {
        return $this->contactUsername;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto $trunksUacreg
     *
     * @return static
     */
    public function setTrunksUacreg(\Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto $trunksUacreg = null)
    {
        $this->trunksUacreg = $trunksUacreg;

        return $this;
    }

    /**
     * @return \Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto
     */
    public function getTrunksUacreg()
    {
        return $this->trunksUacreg;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setTrunksUacregId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto($id)
            : null;

        return $this->setTrunksUacreg($value);
    }

    /**
     * @return integer | null
     */
    public function getTrunksUacregId()
    {
        if ($dto = $this->getTrunksUacreg()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto $ddiProvider
     *
     * @return static
     */
    public function setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto $ddiProvider = null)
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto
     */
    public function getDdiProvider()
    {
        return $this->ddiProvider;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setDdiProviderId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto($id)
            : null;

        return $this->setDdiProvider($value);
    }

    /**
     * @return integer | null
     */
    public function getDdiProviderId()
    {
        if ($dto = $this->getDdiProvider()) {
            return $dto->getId();
        }

        return null;
    }
}
