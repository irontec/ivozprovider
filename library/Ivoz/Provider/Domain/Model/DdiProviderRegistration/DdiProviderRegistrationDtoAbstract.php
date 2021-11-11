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
     * @var string|null
     */
    private $username = '';

    /**
     * @var string|null
     */
    private $domain = '';

    /**
     * @var string|null
     */
    private $realm = '';

    /**
     * @var string|null
     */
    private $authUsername = '';

    /**
     * @var string|null
     */
    private $authPassword = '';

    /**
     * @var string|null
     */
    private $authProxy = '';

    /**
     * @var int|null
     */
    private $expires = 0;

    /**
     * @var bool|null
     */
    private $multiDdi = false;

    /**
     * @var string|null
     */
    private $contactUsername = '';

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var DdiProviderDto | null
     */
    private $ddiProvider = null;

    /**
     * @var TrunksUacregDto | null
     */
    private $trunksUacreg = null;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
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
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
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

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setDomain(string $domain): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setRealm(string $realm): static
    {
        $this->realm = $realm;

        return $this;
    }

    public function getRealm(): ?string
    {
        return $this->realm;
    }

    public function setAuthUsername(string $authUsername): static
    {
        $this->authUsername = $authUsername;

        return $this;
    }

    public function getAuthUsername(): ?string
    {
        return $this->authUsername;
    }

    public function setAuthPassword(string $authPassword): static
    {
        $this->authPassword = $authPassword;

        return $this;
    }

    public function getAuthPassword(): ?string
    {
        return $this->authPassword;
    }

    public function setAuthProxy(string $authProxy): static
    {
        $this->authProxy = $authProxy;

        return $this;
    }

    public function getAuthProxy(): ?string
    {
        return $this->authProxy;
    }

    public function setExpires(int $expires): static
    {
        $this->expires = $expires;

        return $this;
    }

    public function getExpires(): ?int
    {
        return $this->expires;
    }

    public function setMultiDdi(?bool $multiDdi): static
    {
        $this->multiDdi = $multiDdi;

        return $this;
    }

    public function getMultiDdi(): ?bool
    {
        return $this->multiDdi;
    }

    public function setContactUsername(string $contactUsername): static
    {
        $this->contactUsername = $contactUsername;

        return $this;
    }

    public function getContactUsername(): ?string
    {
        return $this->contactUsername;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setDdiProvider(?DdiProviderDto $ddiProvider): static
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    public function getDdiProvider(): ?DdiProviderDto
    {
        return $this->ddiProvider;
    }

    public function setDdiProviderId($id): static
    {
        $value = !is_null($id)
            ? new DdiProviderDto($id)
            : null;

        return $this->setDdiProvider($value);
    }

    public function getDdiProviderId()
    {
        if ($dto = $this->getDdiProvider()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTrunksUacreg(?TrunksUacregDto $trunksUacreg): static
    {
        $this->trunksUacreg = $trunksUacreg;

        return $this;
    }

    public function getTrunksUacreg(): ?TrunksUacregDto
    {
        return $this->trunksUacreg;
    }

    public function setTrunksUacregId($id): static
    {
        $value = !is_null($id)
            ? new TrunksUacregDto($id)
            : null;

        return $this->setTrunksUacreg($value);
    }

    public function getTrunksUacregId()
    {
        if ($dto = $this->getTrunksUacreg()) {
            return $dto->getId();
        }

        return null;
    }
}
