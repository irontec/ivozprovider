<?php

namespace Ivoz\Provider\Domain\Model\Friend;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use Ivoz\Provider\Domain\Model\CallAcl\CallAclDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\Language\LanguageDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyDto;
use Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternDto;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingDto;

/**
* FriendDtoAbstract
* @codeCoverageIgnore
*/
abstract class FriendDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var string|null
     */
    private $description = '';

    /**
     * @var string|null
     */
    private $transport = null;

    /**
     * @var string|null
     */
    private $ip = null;

    /**
     * @var int|null
     */
    private $port = null;

    /**
     * @var string|null
     */
    private $password = null;

    /**
     * @var int|null
     */
    private $priority = 1;

    /**
     * @var string|null
     */
    private $disallow = 'all';

    /**
     * @var string|null
     */
    private $allow = 'alaw';

    /**
     * @var string|null
     */
    private $directMediaMethod = 'update';

    /**
     * @var string|null
     */
    private $calleridUpdateHeader = 'pai';

    /**
     * @var string|null
     */
    private $updateCallerid = 'yes';

    /**
     * @var string|null
     */
    private $fromUser = null;

    /**
     * @var string|null
     */
    private $fromDomain = null;

    /**
     * @var string|null
     */
    private $directConnectivity = 'yes';

    /**
     * @var string|null
     */
    private $ddiIn = 'yes';

    /**
     * @var string|null
     */
    private $t38Passthrough = 'no';

    /**
     * @var bool|null
     */
    private $alwaysApplyTransformations = false;

    /**
     * @var bool|null
     */
    private $rtpEncryption = false;

    /**
     * @var bool|null
     */
    private $multiContact = true;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var DomainDto | null
     */
    private $domain = null;

    /**
     * @var TransformationRuleSetDto | null
     */
    private $transformationRuleSet = null;

    /**
     * @var CallAclDto | null
     */
    private $callAcl = null;

    /**
     * @var DdiDto | null
     */
    private $outgoingDdi = null;

    /**
     * @var LanguageDto | null
     */
    private $language = null;

    /**
     * @var CompanyDto | null
     */
    private $interCompany = null;

    /**
     * @var PsEndpointDto | null
     */
    private $psEndpoint = null;

    /**
     * @var PsIdentifyDto | null
     */
    private $psIdentify = null;

    /**
     * @var FriendsPatternDto[] | null
     */
    private $patterns = null;

    /**
     * @var CallForwardSettingDto[] | null
     */
    private $callForwardSettings = null;

    /**
     * @param string|int|null $id
     */
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
            'name' => 'name',
            'description' => 'description',
            'transport' => 'transport',
            'ip' => 'ip',
            'port' => 'port',
            'password' => 'password',
            'priority' => 'priority',
            'disallow' => 'disallow',
            'allow' => 'allow',
            'directMediaMethod' => 'directMediaMethod',
            'calleridUpdateHeader' => 'calleridUpdateHeader',
            'updateCallerid' => 'updateCallerid',
            'fromUser' => 'fromUser',
            'fromDomain' => 'fromDomain',
            'directConnectivity' => 'directConnectivity',
            'ddiIn' => 'ddiIn',
            't38Passthrough' => 't38Passthrough',
            'alwaysApplyTransformations' => 'alwaysApplyTransformations',
            'rtpEncryption' => 'rtpEncryption',
            'multiContact' => 'multiContact',
            'id' => 'id',
            'companyId' => 'company',
            'domainId' => 'domain',
            'transformationRuleSetId' => 'transformationRuleSet',
            'callAclId' => 'callAcl',
            'outgoingDdiId' => 'outgoingDdi',
            'languageId' => 'language',
            'interCompanyId' => 'interCompany',
            'psEndpointId' => 'psEndpoint',
            'psIdentifyId' => 'psIdentify'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'transport' => $this->getTransport(),
            'ip' => $this->getIp(),
            'port' => $this->getPort(),
            'password' => $this->getPassword(),
            'priority' => $this->getPriority(),
            'disallow' => $this->getDisallow(),
            'allow' => $this->getAllow(),
            'directMediaMethod' => $this->getDirectMediaMethod(),
            'calleridUpdateHeader' => $this->getCalleridUpdateHeader(),
            'updateCallerid' => $this->getUpdateCallerid(),
            'fromUser' => $this->getFromUser(),
            'fromDomain' => $this->getFromDomain(),
            'directConnectivity' => $this->getDirectConnectivity(),
            'ddiIn' => $this->getDdiIn(),
            't38Passthrough' => $this->getT38Passthrough(),
            'alwaysApplyTransformations' => $this->getAlwaysApplyTransformations(),
            'rtpEncryption' => $this->getRtpEncryption(),
            'multiContact' => $this->getMultiContact(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'domain' => $this->getDomain(),
            'transformationRuleSet' => $this->getTransformationRuleSet(),
            'callAcl' => $this->getCallAcl(),
            'outgoingDdi' => $this->getOutgoingDdi(),
            'language' => $this->getLanguage(),
            'interCompany' => $this->getInterCompany(),
            'psEndpoint' => $this->getPsEndpoint(),
            'psIdentify' => $this->getPsIdentify(),
            'patterns' => $this->getPatterns(),
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

    public function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setDisallow(string $disallow): static
    {
        $this->disallow = $disallow;

        return $this;
    }

    public function getDisallow(): ?string
    {
        return $this->disallow;
    }

    public function setAllow(string $allow): static
    {
        $this->allow = $allow;

        return $this;
    }

    public function getAllow(): ?string
    {
        return $this->allow;
    }

    public function setDirectMediaMethod(string $directMediaMethod): static
    {
        $this->directMediaMethod = $directMediaMethod;

        return $this;
    }

    public function getDirectMediaMethod(): ?string
    {
        return $this->directMediaMethod;
    }

    public function setCalleridUpdateHeader(string $calleridUpdateHeader): static
    {
        $this->calleridUpdateHeader = $calleridUpdateHeader;

        return $this;
    }

    public function getCalleridUpdateHeader(): ?string
    {
        return $this->calleridUpdateHeader;
    }

    public function setUpdateCallerid(string $updateCallerid): static
    {
        $this->updateCallerid = $updateCallerid;

        return $this;
    }

    public function getUpdateCallerid(): ?string
    {
        return $this->updateCallerid;
    }

    public function setFromUser(?string $fromUser): static
    {
        $this->fromUser = $fromUser;

        return $this;
    }

    public function getFromUser(): ?string
    {
        return $this->fromUser;
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

    public function setAlwaysApplyTransformations(bool $alwaysApplyTransformations): static
    {
        $this->alwaysApplyTransformations = $alwaysApplyTransformations;

        return $this;
    }

    public function getAlwaysApplyTransformations(): ?bool
    {
        return $this->alwaysApplyTransformations;
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

    public function getId(): ?int
    {
        return $this->id;
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

    public function setCallAcl(?CallAclDto $callAcl): static
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    public function getCallAcl(): ?CallAclDto
    {
        return $this->callAcl;
    }

    public function setCallAclId($id): static
    {
        $value = !is_null($id)
            ? new CallAclDto($id)
            : null;

        return $this->setCallAcl($value);
    }

    public function getCallAclId()
    {
        if ($dto = $this->getCallAcl()) {
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

    public function setLanguage(?LanguageDto $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): ?LanguageDto
    {
        return $this->language;
    }

    public function setLanguageId($id): static
    {
        $value = !is_null($id)
            ? new LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    public function getLanguageId()
    {
        if ($dto = $this->getLanguage()) {
            return $dto->getId();
        }

        return null;
    }

    public function setInterCompany(?CompanyDto $interCompany): static
    {
        $this->interCompany = $interCompany;

        return $this;
    }

    public function getInterCompany(): ?CompanyDto
    {
        return $this->interCompany;
    }

    public function setInterCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setInterCompany($value);
    }

    public function getInterCompanyId()
    {
        if ($dto = $this->getInterCompany()) {
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

    public function setPatterns(?array $patterns): static
    {
        $this->patterns = $patterns;

        return $this;
    }

    /**
    * @return FriendsPatternDto[] | null
    */
    public function getPatterns(): ?array
    {
        return $this->patterns;
    }

    public function setCallForwardSettings(?array $callForwardSettings): static
    {
        $this->callForwardSettings = $callForwardSettings;

        return $this;
    }

    /**
    * @return CallForwardSettingDto[] | null
    */
    public function getCallForwardSettings(): ?array
    {
        return $this->callForwardSettings;
    }
}
