<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationDto;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;

/**
* TrunksUacregDtoAbstract
* @codeCoverageIgnore
*/
abstract class TrunksUacregDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $lUuid = '';

    /**
     * @var string
     */
    private $lUsername = 'unused';

    /**
     * @var string
     */
    private $lDomain = 'unused';

    /**
     * @var string
     */
    private $rUsername = '';

    /**
     * @var string
     */
    private $rDomain = '';

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
     * @var int
     */
    private $flags = 0;

    /**
     * @var int
     */
    private $regDelay = 0;

    /**
     * @var string
     */
    private $authHa1 = '';

    /**
     * @var int
     */
    private $id;

    /**
     * @var DdiProviderRegistrationDto | null
     */
    private $ddiProviderRegistration;

    /**
     * @var BrandDto | null
     */
    private $brand;

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
            'lUuid' => 'lUuid',
            'lUsername' => 'lUsername',
            'lDomain' => 'lDomain',
            'rUsername' => 'rUsername',
            'rDomain' => 'rDomain',
            'realm' => 'realm',
            'authUsername' => 'authUsername',
            'authPassword' => 'authPassword',
            'authProxy' => 'authProxy',
            'expires' => 'expires',
            'flags' => 'flags',
            'regDelay' => 'regDelay',
            'authHa1' => 'authHa1',
            'id' => 'id',
            'ddiProviderRegistrationId' => 'ddiProviderRegistration',
            'brandId' => 'brand'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'lUuid' => $this->getLUuid(),
            'lUsername' => $this->getLUsername(),
            'lDomain' => $this->getLDomain(),
            'rUsername' => $this->getRUsername(),
            'rDomain' => $this->getRDomain(),
            'realm' => $this->getRealm(),
            'authUsername' => $this->getAuthUsername(),
            'authPassword' => $this->getAuthPassword(),
            'authProxy' => $this->getAuthProxy(),
            'expires' => $this->getExpires(),
            'flags' => $this->getFlags(),
            'regDelay' => $this->getRegDelay(),
            'authHa1' => $this->getAuthHa1(),
            'id' => $this->getId(),
            'ddiProviderRegistration' => $this->getDdiProviderRegistration(),
            'brand' => $this->getBrand()
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

    public function setLUuid(?string $lUuid): static
    {
        $this->lUuid = $lUuid;

        return $this;
    }

    public function getLUuid(): ?string
    {
        return $this->lUuid;
    }

    public function setLUsername(?string $lUsername): static
    {
        $this->lUsername = $lUsername;

        return $this;
    }

    public function getLUsername(): ?string
    {
        return $this->lUsername;
    }

    public function setLDomain(?string $lDomain): static
    {
        $this->lDomain = $lDomain;

        return $this;
    }

    public function getLDomain(): ?string
    {
        return $this->lDomain;
    }

    public function setRUsername(?string $rUsername): static
    {
        $this->rUsername = $rUsername;

        return $this;
    }

    public function getRUsername(): ?string
    {
        return $this->rUsername;
    }

    public function setRDomain(?string $rDomain): static
    {
        $this->rDomain = $rDomain;

        return $this;
    }

    public function getRDomain(): ?string
    {
        return $this->rDomain;
    }

    public function setRealm(?string $realm): static
    {
        $this->realm = $realm;

        return $this;
    }

    public function getRealm(): ?string
    {
        return $this->realm;
    }

    public function setAuthUsername(?string $authUsername): static
    {
        $this->authUsername = $authUsername;

        return $this;
    }

    public function getAuthUsername(): ?string
    {
        return $this->authUsername;
    }

    public function setAuthPassword(?string $authPassword): static
    {
        $this->authPassword = $authPassword;

        return $this;
    }

    public function getAuthPassword(): ?string
    {
        return $this->authPassword;
    }

    public function setAuthProxy(?string $authProxy): static
    {
        $this->authProxy = $authProxy;

        return $this;
    }

    public function getAuthProxy(): ?string
    {
        return $this->authProxy;
    }

    public function setExpires(?int $expires): static
    {
        $this->expires = $expires;

        return $this;
    }

    public function getExpires(): ?int
    {
        return $this->expires;
    }

    public function setFlags(?int $flags): static
    {
        $this->flags = $flags;

        return $this;
    }

    public function getFlags(): ?int
    {
        return $this->flags;
    }

    public function setRegDelay(?int $regDelay): static
    {
        $this->regDelay = $regDelay;

        return $this;
    }

    public function getRegDelay(): ?int
    {
        return $this->regDelay;
    }

    public function setAuthHa1(?string $authHa1): static
    {
        $this->authHa1 = $authHa1;

        return $this;
    }

    public function getAuthHa1(): ?string
    {
        return $this->authHa1;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setDdiProviderRegistration(?DdiProviderRegistrationDto $ddiProviderRegistration): static
    {
        $this->ddiProviderRegistration = $ddiProviderRegistration;

        return $this;
    }

    public function getDdiProviderRegistration(): ?DdiProviderRegistrationDto
    {
        return $this->ddiProviderRegistration;
    }

    public function setDdiProviderRegistrationId($id): static
    {
        $value = !is_null($id)
            ? new DdiProviderRegistrationDto($id)
            : null;

        return $this->setDdiProviderRegistration($value);
    }

    public function getDdiProviderRegistrationId()
    {
        if ($dto = $this->getDdiProviderRegistration()) {
            return $dto->getId();
        }

        return null;
    }

    public function setBrand(?BrandDto $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    public function setBrandId($id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

}
