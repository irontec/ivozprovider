<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderRegistration;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderDto;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto;

/**
* DdiProviderRegistrationDtoAbstract
* @codeCoverageIgnore
*/
abstract class DdiProviderRegistrationDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

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
     * @var int
     */
    private $expires = 0;

    /**
     * @var bool | null
     */
    private $multiDdi = false;

    /**
     * @var string
     */
    private $contactUsername = '';

    /**
     * @var int
     */
    private $id;

    /**
     * @var DdiProviderDto | null
     */
    private $ddiProvider;

    /**
     * @var TrunksUacregDto | null
     */
    private $trunksUacreg;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
            'ddiProviderId' => 'ddiProvider',
            'trunksUacregId' => 'trunksUacreg'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
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
            'ddiProvider' => $this->getDdiProvider(),
            'trunksUacreg' => $this->getTrunksUacreg()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param string $username | null
     *
     * @return static
     */
    public function setUsername(?string $username = null): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $domain | null
     *
     * @return static
     */
    public function setDomain(?string $domain = null): self
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @param string $realm | null
     *
     * @return static
     */
    public function setRealm(?string $realm = null): self
    {
        $this->realm = $realm;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRealm(): ?string
    {
        return $this->realm;
    }

    /**
     * @param string $authUsername | null
     *
     * @return static
     */
    public function setAuthUsername(?string $authUsername = null): self
    {
        $this->authUsername = $authUsername;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAuthUsername(): ?string
    {
        return $this->authUsername;
    }

    /**
     * @param string $authPassword | null
     *
     * @return static
     */
    public function setAuthPassword(?string $authPassword = null): self
    {
        $this->authPassword = $authPassword;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAuthPassword(): ?string
    {
        return $this->authPassword;
    }

    /**
     * @param string $authProxy | null
     *
     * @return static
     */
    public function setAuthProxy(?string $authProxy = null): self
    {
        $this->authProxy = $authProxy;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAuthProxy(): ?string
    {
        return $this->authProxy;
    }

    /**
     * @param int $expires | null
     *
     * @return static
     */
    public function setExpires(?int $expires = null): self
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getExpires(): ?int
    {
        return $this->expires;
    }

    /**
     * @param bool $multiDdi | null
     *
     * @return static
     */
    public function setMultiDdi(?bool $multiDdi = null): self
    {
        $this->multiDdi = $multiDdi;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getMultiDdi(): ?bool
    {
        return $this->multiDdi;
    }

    /**
     * @param string $contactUsername | null
     *
     * @return static
     */
    public function setContactUsername(?string $contactUsername = null): self
    {
        $this->contactUsername = $contactUsername;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getContactUsername(): ?string
    {
        return $this->contactUsername;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param DdiProviderDto | null
     *
     * @return static
     */
    public function setDdiProvider(?DdiProviderDto $ddiProvider = null): self
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * @return DdiProviderDto | null
     */
    public function getDdiProvider(): ?DdiProviderDto
    {
        return $this->ddiProvider;
    }

    /**
     * @return static
     */
    public function setDdiProviderId($id): self
    {
        $value = !is_null($id)
            ? new DdiProviderDto($id)
            : null;

        return $this->setDdiProvider($value);
    }

    /**
     * @return mixed | null
     */
    public function getDdiProviderId()
    {
        if ($dto = $this->getDdiProvider()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TrunksUacregDto | null
     *
     * @return static
     */
    public function setTrunksUacreg(?TrunksUacregDto $trunksUacreg = null): self
    {
        $this->trunksUacreg = $trunksUacreg;

        return $this;
    }

    /**
     * @return TrunksUacregDto | null
     */
    public function getTrunksUacreg(): ?TrunksUacregDto
    {
        return $this->trunksUacreg;
    }

    /**
     * @return static
     */
    public function setTrunksUacregId($id): self
    {
        $value = !is_null($id)
            ? new TrunksUacregDto($id)
            : null;

        return $this->setTrunksUacreg($value);
    }

    /**
     * @return mixed | null
     */
    public function getTrunksUacregId()
    {
        if ($dto = $this->getTrunksUacreg()) {
            return $dto->getId();
        }

        return null;
    }

}
