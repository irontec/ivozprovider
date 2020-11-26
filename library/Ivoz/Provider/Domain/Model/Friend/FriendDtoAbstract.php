<?php

namespace Ivoz\Provider\Domain\Model\Friend;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto;
use Ivoz\Provider\Domain\Model\CallAcl\CallAclDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\Language\LanguageDto;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto;
use Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternDto;

/**
* FriendDtoAbstract
* @codeCoverageIgnore
*/
abstract class FriendDtoAbstract implements DataTransferObjectInterface
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
     * @var string | null
     */
    private $transport;

    /**
     * @var string | null
     */
    private $ip;

    /**
     * @var int | null
     */
    private $port;

    /**
     * @var string | null
     */
    private $password;

    /**
     * @var int
     */
    private $priority = 1;

    /**
     * @var string
     */
    private $disallow = 'all';

    /**
     * @var string
     */
    private $allow = 'alaw';

    /**
     * @var string
     */
    private $directMediaMethod = 'update';

    /**
     * @var string
     */
    private $calleridUpdateHeader = 'pai';

    /**
     * @var string
     */
    private $updateCallerid = 'yes';

    /**
     * @var string | null
     */
    private $fromUser;

    /**
     * @var string | null
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
    private $alwaysApplyTransformations = false;

    /**
     * @var bool
     */
    private $rtpEncryption = false;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var DomainDto | null
     */
    private $domain;

    /**
     * @var TransformationRuleSetDto | null
     */
    private $transformationRuleSet;

    /**
     * @var CallAclDto | null
     */
    private $callAcl;

    /**
     * @var DdiDto | null
     */
    private $outgoingDdi;

    /**
     * @var LanguageDto | null
     */
    private $language;

    /**
     * @var CompanyDto | null
     */
    private $interCompany;

    /**
     * @var PsEndpointDto[] | null
     */
    private $psEndpoints;

    /**
     * @var FriendsPatternDto[] | null
     */
    private $patterns;

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
            'id' => 'id',
            'companyId' => 'company',
            'domainId' => 'domain',
            'transformationRuleSetId' => 'transformationRuleSet',
            'callAclId' => 'callAcl',
            'outgoingDdiId' => 'outgoingDdi',
            'languageId' => 'language',
            'interCompanyId' => 'interCompany'
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
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'domain' => $this->getDomain(),
            'transformationRuleSet' => $this->getTransformationRuleSet(),
            'callAcl' => $this->getCallAcl(),
            'outgoingDdi' => $this->getOutgoingDdi(),
            'language' => $this->getLanguage(),
            'interCompany' => $this->getInterCompany(),
            'psEndpoints' => $this->getPsEndpoints(),
            'patterns' => $this->getPatterns()
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
     * @param string $name | null
     *
     * @return static
     */
    public function setName(?string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $description | null
     *
     * @return static
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $transport | null
     *
     * @return static
     */
    public function setTransport(?string $transport = null): self
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTransport(): ?string
    {
        return $this->transport;
    }

    /**
     * @param string $ip | null
     *
     * @return static
     */
    public function setIp(?string $ip = null): self
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param int $port | null
     *
     * @return static
     */
    public function setPort(?int $port = null): self
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * @param string $password | null
     *
     * @return static
     */
    public function setPassword(?string $password = null): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param int $priority | null
     *
     * @return static
     */
    public function setPriority(?int $priority = null): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
    }

    /**
     * @param string $disallow | null
     *
     * @return static
     */
    public function setDisallow(?string $disallow = null): self
    {
        $this->disallow = $disallow;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDisallow(): ?string
    {
        return $this->disallow;
    }

    /**
     * @param string $allow | null
     *
     * @return static
     */
    public function setAllow(?string $allow = null): self
    {
        $this->allow = $allow;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAllow(): ?string
    {
        return $this->allow;
    }

    /**
     * @param string $directMediaMethod | null
     *
     * @return static
     */
    public function setDirectMediaMethod(?string $directMediaMethod = null): self
    {
        $this->directMediaMethod = $directMediaMethod;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirectMediaMethod(): ?string
    {
        return $this->directMediaMethod;
    }

    /**
     * @param string $calleridUpdateHeader | null
     *
     * @return static
     */
    public function setCalleridUpdateHeader(?string $calleridUpdateHeader = null): self
    {
        $this->calleridUpdateHeader = $calleridUpdateHeader;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCalleridUpdateHeader(): ?string
    {
        return $this->calleridUpdateHeader;
    }

    /**
     * @param string $updateCallerid | null
     *
     * @return static
     */
    public function setUpdateCallerid(?string $updateCallerid = null): self
    {
        $this->updateCallerid = $updateCallerid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUpdateCallerid(): ?string
    {
        return $this->updateCallerid;
    }

    /**
     * @param string $fromUser | null
     *
     * @return static
     */
    public function setFromUser(?string $fromUser = null): self
    {
        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFromUser(): ?string
    {
        return $this->fromUser;
    }

    /**
     * @param string $fromDomain | null
     *
     * @return static
     */
    public function setFromDomain(?string $fromDomain = null): self
    {
        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFromDomain(): ?string
    {
        return $this->fromDomain;
    }

    /**
     * @param string $directConnectivity | null
     *
     * @return static
     */
    public function setDirectConnectivity(?string $directConnectivity = null): self
    {
        $this->directConnectivity = $directConnectivity;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirectConnectivity(): ?string
    {
        return $this->directConnectivity;
    }

    /**
     * @param string $ddiIn | null
     *
     * @return static
     */
    public function setDdiIn(?string $ddiIn = null): self
    {
        $this->ddiIn = $ddiIn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDdiIn(): ?string
    {
        return $this->ddiIn;
    }

    /**
     * @param string $t38Passthrough | null
     *
     * @return static
     */
    public function setT38Passthrough(?string $t38Passthrough = null): self
    {
        $this->t38Passthrough = $t38Passthrough;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getT38Passthrough(): ?string
    {
        return $this->t38Passthrough;
    }

    /**
     * @param bool $alwaysApplyTransformations | null
     *
     * @return static
     */
    public function setAlwaysApplyTransformations(?bool $alwaysApplyTransformations = null): self
    {
        $this->alwaysApplyTransformations = $alwaysApplyTransformations;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getAlwaysApplyTransformations(): ?bool
    {
        return $this->alwaysApplyTransformations;
    }

    /**
     * @param bool $rtpEncryption | null
     *
     * @return static
     */
    public function setRtpEncryption(?bool $rtpEncryption = null): self
    {
        $this->rtpEncryption = $rtpEncryption;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getRtpEncryption(): ?bool
    {
        return $this->rtpEncryption;
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
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DomainDto | null
     *
     * @return static
     */
    public function setDomain(?DomainDto $domain = null): self
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return DomainDto | null
     */
    public function getDomain(): ?DomainDto
    {
        return $this->domain;
    }

    /**
     * @return static
     */
    public function setDomainId($id): self
    {
        $value = !is_null($id)
            ? new DomainDto($id)
            : null;

        return $this->setDomain($value);
    }

    /**
     * @return mixed | null
     */
    public function getDomainId()
    {
        if ($dto = $this->getDomain()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param TransformationRuleSetDto | null
     *
     * @return static
     */
    public function setTransformationRuleSet(?TransformationRuleSetDto $transformationRuleSet = null): self
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * @return TransformationRuleSetDto | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetDto
    {
        return $this->transformationRuleSet;
    }

    /**
     * @return static
     */
    public function setTransformationRuleSetId($id): self
    {
        $value = !is_null($id)
            ? new TransformationRuleSetDto($id)
            : null;

        return $this->setTransformationRuleSet($value);
    }

    /**
     * @return mixed | null
     */
    public function getTransformationRuleSetId()
    {
        if ($dto = $this->getTransformationRuleSet()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CallAclDto | null
     *
     * @return static
     */
    public function setCallAcl(?CallAclDto $callAcl = null): self
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    /**
     * @return CallAclDto | null
     */
    public function getCallAcl(): ?CallAclDto
    {
        return $this->callAcl;
    }

    /**
     * @return static
     */
    public function setCallAclId($id): self
    {
        $value = !is_null($id)
            ? new CallAclDto($id)
            : null;

        return $this->setCallAcl($value);
    }

    /**
     * @return mixed | null
     */
    public function getCallAclId()
    {
        if ($dto = $this->getCallAcl()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DdiDto | null
     *
     * @return static
     */
    public function setOutgoingDdi(?DdiDto $outgoingDdi = null): self
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * @return DdiDto | null
     */
    public function getOutgoingDdi(): ?DdiDto
    {
        return $this->outgoingDdi;
    }

    /**
     * @return static
     */
    public function setOutgoingDdiId($id): self
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setOutgoingDdi($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutgoingDdiId()
    {
        if ($dto = $this->getOutgoingDdi()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param LanguageDto | null
     *
     * @return static
     */
    public function setLanguage(?LanguageDto $language = null): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return LanguageDto | null
     */
    public function getLanguage(): ?LanguageDto
    {
        return $this->language;
    }

    /**
     * @return static
     */
    public function setLanguageId($id): self
    {
        $value = !is_null($id)
            ? new LanguageDto($id)
            : null;

        return $this->setLanguage($value);
    }

    /**
     * @return mixed | null
     */
    public function getLanguageId()
    {
        if ($dto = $this->getLanguage()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setInterCompany(?CompanyDto $interCompany = null): self
    {
        $this->interCompany = $interCompany;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getInterCompany(): ?CompanyDto
    {
        return $this->interCompany;
    }

    /**
     * @return static
     */
    public function setInterCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setInterCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getInterCompanyId()
    {
        if ($dto = $this->getInterCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param PsEndpointDto[] | null
     *
     * @return static
     */
    public function setPsEndpoints(?array $psEndpoints = null): self
    {
        $this->psEndpoints = $psEndpoints;

        return $this;
    }

    /**
     * @return PsEndpointDto[] | null
     */
    public function getPsEndpoints(): ?array
    {
        return $this->psEndpoints;
    }

    /**
     * @param FriendsPatternDto[] | null
     *
     * @return static
     */
    public function setPatterns(?array $patterns = null): self
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

}
