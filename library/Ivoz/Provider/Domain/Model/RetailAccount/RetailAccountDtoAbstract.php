<?php

namespace Ivoz\Provider\Domain\Model\RetailAccount;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyDto;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingDto;

/**
* RetailAccountDtoAbstract
* @codeCoverageIgnore
*/
abstract class RetailAccountDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var string|null
     */
    private $transport;

    /**
     * @var string|null
     */
    private $ip;

    /**
     * @var int|null
     */
    private $port;

    /**
     * @var string|null
     */
    private $password;

    /**
     * @var string|null
     */
    private $fromDomain;

    /**
     * @var string
     */
    private $directConnectivity = 'yes';

    /**
     * @var string
     */
    private $ddiIn = 'yes';

    /**
     * @var string
     */
    private $t38Passthrough = 'no';

    /**
     * @var bool
     */
    private $rtpEncryption = false;

    /**
     * @var bool
     */
    private $multiContact = true;

    /**
     * @var int
     */
    private $id;

    /**
     * @var BrandDto | null
     */
    private $brand;

    /**
     * @var DomainDto | null
     */
    private $domain;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var TransformationRuleSetDto | null
     */
    private $transformationRuleSet;

    /**
     * @var DdiDto | null
     */
    private $outgoingDdi;

    /**
     * @var PsEndpointDto | null
     */
    private $psEndpoint;

    /**
     * @var PsIdentifyDto | null
     */
    private $psIdentify;

    /**
     * @var DdiDto[] | null
     */
    private $ddis;

    /**
     * @var CallForwardSettingDto[] | null
     */
    private $callForwardSettings;

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
            'name' => 'name',
            'description' => 'description',
            'transport' => 'transport',
            'ip' => 'ip',
            'port' => 'port',
            'password' => 'password',
            'fromDomain' => 'fromDomain',
            'directConnectivity' => 'directConnectivity',
            'ddiIn' => 'ddiIn',
            't38Passthrough' => 't38Passthrough',
            'rtpEncryption' => 'rtpEncryption',
            'multiContact' => 'multiContact',
            'id' => 'id',
            'brandId' => 'brand',
            'domainId' => 'domain',
            'companyId' => 'company',
            'transformationRuleSetId' => 'transformationRuleSet',
            'outgoingDdiId' => 'outgoingDdi',
            'psEndpointId' => 'psEndpoint',
            'psIdentifyId' => 'psIdentify'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'transport' => $this->getTransport(),
            'ip' => $this->getIp(),
            'port' => $this->getPort(),
            'password' => $this->getPassword(),
            'fromDomain' => $this->getFromDomain(),
            'directConnectivity' => $this->getDirectConnectivity(),
            'ddiIn' => $this->getDdiIn(),
            't38Passthrough' => $this->getT38Passthrough(),
            'rtpEncryption' => $this->getRtpEncryption(),
            'multiContact' => $this->getMultiContact(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'domain' => $this->getDomain(),
            'company' => $this->getCompany(),
            'transformationRuleSet' => $this->getTransformationRuleSet(),
            'outgoingDdi' => $this->getOutgoingDdi(),
            'psEndpoint' => $this->getPsEndpoint(),
            'psIdentify' => $this->getPsIdentify(),
            'ddis' => $this->getDdis(),
            'callForwardSettings' => $this->getCallForwardSettings()
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setTransport(?string $transport): static
    {
        $this->transport = $transport;

        return $this;
    }

    public function getTransport(): ?string
    {
        return $this->transport;
    }

    public function setIp(?string $ip): static
    {
        $this->ip = $ip;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setPort(?int $port): static
    {
        $this->port = $port;

        return $this;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setFromDomain(?string $fromDomain): static
    {
        $this->fromDomain = $fromDomain;

        return $this;
    }

    public function getFromDomain(): ?string
    {
        return $this->fromDomain;
    }

    public function setDirectConnectivity(string $directConnectivity): static
    {
        $this->directConnectivity = $directConnectivity;

        return $this;
    }

    public function getDirectConnectivity(): ?string
    {
        return $this->directConnectivity;
    }

    public function setDdiIn(string $ddiIn): static
    {
        $this->ddiIn = $ddiIn;

        return $this;
    }

    public function getDdiIn(): ?string
    {
        return $this->ddiIn;
    }

    public function setT38Passthrough(string $t38Passthrough): static
    {
        $this->t38Passthrough = $t38Passthrough;

        return $this;
    }

    public function getT38Passthrough(): ?string
    {
        return $this->t38Passthrough;
    }

    public function setRtpEncryption(bool $rtpEncryption): static
    {
        $this->rtpEncryption = $rtpEncryption;

        return $this;
    }

    public function getRtpEncryption(): ?bool
    {
        return $this->rtpEncryption;
    }

    public function setMultiContact(bool $multiContact): static
    {
        $this->multiContact = $multiContact;

        return $this;
    }

    public function getMultiContact(): ?bool
    {
        return $this->multiContact;
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

    public function setDomain(?DomainDto $domain): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): ?DomainDto
    {
        return $this->domain;
    }

    public function setDomainId($id): static
    {
        $value = !is_null($id)
            ? new DomainDto($id)
            : null;

        return $this->setDomain($value);
    }

    public function getDomainId()
    {
        if ($dto = $this->getDomain()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setTransformationRuleSet(?TransformationRuleSetDto $transformationRuleSet): static
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    public function getTransformationRuleSet(): ?TransformationRuleSetDto
    {
        return $this->transformationRuleSet;
    }

    public function setTransformationRuleSetId($id): static
    {
        $value = !is_null($id)
            ? new TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    public function getTransformationRuleSetId()
    {
        if ($dto = $this->getTransformationRuleSet()) {
            return $dto->getId();
        }

        return null;
    }

    public function setOutgoingDdi(?DdiDto $outgoingDdi): static
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    public function getOutgoingDdi(): ?DdiDto
    {
        return $this->outgoingDdi;
    }

    public function setOutgoingDdiId($id): static
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setOutgoingDdi($value);
    }

    public function getOutgoingDdiId()
    {
        if ($dto = $this->getOutgoingDdi()) {
            return $dto->getId();
        }

        return null;
    }

    public function setPsEndpoint(?PsEndpointDto $psEndpoint): static
    {
        $this->psEndpoint = $psEndpoint;

        return $this;
    }

    public function getPsEndpoint(): ?PsEndpointDto
    {
        return $this->psEndpoint;
    }

    public function setPsEndpointId($id): static
    {
        $value = !is_null($id)
            ? new PsEndpointDto($id)
            : null;

        return $this->setPsEndpoint($value);
    }

    public function getPsEndpointId()
    {
        if ($dto = $this->getPsEndpoint()) {
            return $dto->getId();
        }

        return null;
    }

    public function setPsIdentify(?PsIdentifyDto $psIdentify): static
    {
        $this->psIdentify = $psIdentify;

        return $this;
    }

    public function getPsIdentify(): ?PsIdentifyDto
    {
        return $this->psIdentify;
    }

    public function setPsIdentifyId($id): static
    {
        $value = !is_null($id)
            ? new PsIdentifyDto($id)
            : null;

        return $this->setPsIdentify($value);
    }

    public function getPsIdentifyId()
    {
        if ($dto = $this->getPsIdentify()) {
            return $dto->getId();
        }

        return null;
    }

    public function setDdis(?array $ddis): static
    {
        $this->ddis = $ddis;

        return $this;
    }

    public function getDdis(): ?array
    {
        return $this->ddis;
    }

    public function setCallForwardSettings(?array $callForwardSettings): static
    {
        $this->callForwardSettings = $callForwardSettings;

        return $this;
    }

    public function getCallForwardSettings(): ?array
    {
        return $this->callForwardSettings;
    }
}
