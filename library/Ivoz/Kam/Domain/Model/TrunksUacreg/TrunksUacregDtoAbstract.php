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

    /**
     * @param string $lUuid | null
     *
     * @return static
     */
    public function setLUuid(?string $lUuid = null): self
    {
        $this->lUuid = $lUuid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLUuid(): ?string
    {
        return $this->lUuid;
    }

    /**
     * @param string $lUsername | null
     *
     * @return static
     */
    public function setLUsername(?string $lUsername = null): self
    {
        $this->lUsername = $lUsername;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLUsername(): ?string
    {
        return $this->lUsername;
    }

    /**
     * @param string $lDomain | null
     *
     * @return static
     */
    public function setLDomain(?string $lDomain = null): self
    {
        $this->lDomain = $lDomain;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLDomain(): ?string
    {
        return $this->lDomain;
    }

    /**
     * @param string $rUsername | null
     *
     * @return static
     */
    public function setRUsername(?string $rUsername = null): self
    {
        $this->rUsername = $rUsername;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRUsername(): ?string
    {
        return $this->rUsername;
    }

    /**
     * @param string $rDomain | null
     *
     * @return static
     */
    public function setRDomain(?string $rDomain = null): self
    {
        $this->rDomain = $rDomain;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRDomain(): ?string
    {
        return $this->rDomain;
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
     * @param int $flags | null
     *
     * @return static
     */
    public function setFlags(?int $flags = null): self
    {
        $this->flags = $flags;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getFlags(): ?int
    {
        return $this->flags;
    }

    /**
     * @param int $regDelay | null
     *
     * @return static
     */
    public function setRegDelay(?int $regDelay = null): self
    {
        $this->regDelay = $regDelay;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getRegDelay(): ?int
    {
        return $this->regDelay;
    }

    /**
     * @param string $authHa1 | null
     *
     * @return static
     */
    public function setAuthHa1(?string $authHa1 = null): self
    {
        $this->authHa1 = $authHa1;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAuthHa1(): ?string
    {
        return $this->authHa1;
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
     * @param DdiProviderRegistrationDto | null
     *
     * @return static
     */
    public function setDdiProviderRegistration(?DdiProviderRegistrationDto $ddiProviderRegistration = null): self
    {
        $this->ddiProviderRegistration = $ddiProviderRegistration;

        return $this;
    }

    /**
     * @return DdiProviderRegistrationDto | null
     */
    public function getDdiProviderRegistration(): ?DdiProviderRegistrationDto
    {
        return $this->ddiProviderRegistration;
    }

    /**
     * @return static
     */
    public function setDdiProviderRegistrationId($id): self
    {
        $value = !is_null($id)
            ? new DdiProviderRegistrationDto($id)
            : null;

        return $this->setDdiProviderRegistration($value);
    }

    /**
     * @return mixed | null
     */
    public function getDdiProviderRegistrationId()
    {
        if ($dto = $this->getDdiProviderRegistration()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param BrandDto | null
     *
     * @return static
     */
    public function setBrand(?BrandDto $brand = null): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return BrandDto | null
     */
    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    /**
     * @return static
     */
    public function setBrandId($id): self
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return mixed | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }

}
