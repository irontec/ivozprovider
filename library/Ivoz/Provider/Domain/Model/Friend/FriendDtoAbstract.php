<?php

namespace Ivoz\Provider\Domain\Model\Friend;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class FriendDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var string
     */
    private $transport;

    /**
     * @var string
     */
    private $ip;

    /**
     * @var integer
     */
    private $port;

    /**
     * @var string
     */
    private $password;

    /**
     * @var integer
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
     * @var string
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
     * @var boolean
     */
    private $alwaysApplyTransformations = false;

    /**
     * @var boolean
     */
    private $rtpEncryption = false;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Domain\DomainDto | null
     */
    private $domain;

    /**
     * @var \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto | null
     */
    private $transformationRuleSet;

    /**
     * @var \Ivoz\Provider\Domain\Model\CallAcl\CallAclDto | null
     */
    private $callAcl;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiDto | null
     */
    private $outgoingDdi;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageDto | null
     */
    private $language;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $interCompany;

    /**
     * @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointDto[] | null
     */
    private $psEndpoints = null;

    /**
     * @var \Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPatternDto[] | null
     */
    private $patterns = null;


    use DtoNormalizer;

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
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $description
     *
     * @return static
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $transport
     *
     * @return static
     */
    public function setTransport($transport = null)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param string $ip
     *
     * @return static
     */
    public function setIp($ip = null)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param integer $port
     *
     * @return static
     */
    public function setPort($port = null)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param string $password
     *
     * @return static
     */
    public function setPassword($password = null)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param integer $priority
     *
     * @return static
     */
    public function setPriority($priority = null)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $disallow
     *
     * @return static
     */
    public function setDisallow($disallow = null)
    {
        $this->disallow = $disallow;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDisallow()
    {
        return $this->disallow;
    }

    /**
     * @param string $allow
     *
     * @return static
     */
    public function setAllow($allow = null)
    {
        $this->allow = $allow;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAllow()
    {
        return $this->allow;
    }

    /**
     * @param string $directMediaMethod
     *
     * @return static
     */
    public function setDirectMediaMethod($directMediaMethod = null)
    {
        $this->directMediaMethod = $directMediaMethod;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirectMediaMethod()
    {
        return $this->directMediaMethod;
    }

    /**
     * @param string $calleridUpdateHeader
     *
     * @return static
     */
    public function setCalleridUpdateHeader($calleridUpdateHeader = null)
    {
        $this->calleridUpdateHeader = $calleridUpdateHeader;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCalleridUpdateHeader()
    {
        return $this->calleridUpdateHeader;
    }

    /**
     * @param string $updateCallerid
     *
     * @return static
     */
    public function setUpdateCallerid($updateCallerid = null)
    {
        $this->updateCallerid = $updateCallerid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUpdateCallerid()
    {
        return $this->updateCallerid;
    }

    /**
     * @param string $fromDomain
     *
     * @return static
     */
    public function setFromDomain($fromDomain = null)
    {
        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getFromDomain()
    {
        return $this->fromDomain;
    }

    /**
     * @param string $directConnectivity
     *
     * @return static
     */
    public function setDirectConnectivity($directConnectivity = null)
    {
        $this->directConnectivity = $directConnectivity;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirectConnectivity()
    {
        return $this->directConnectivity;
    }

    /**
     * @param string $ddiIn
     *
     * @return static
     */
    public function setDdiIn($ddiIn = null)
    {
        $this->ddiIn = $ddiIn;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDdiIn()
    {
        return $this->ddiIn;
    }

    /**
     * @param string $t38Passthrough
     *
     * @return static
     */
    public function setT38Passthrough($t38Passthrough = null)
    {
        $this->t38Passthrough = $t38Passthrough;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getT38Passthrough()
    {
        return $this->t38Passthrough;
    }

    /**
     * @param boolean $alwaysApplyTransformations
     *
     * @return static
     */
    public function setAlwaysApplyTransformations($alwaysApplyTransformations = null)
    {
        $this->alwaysApplyTransformations = $alwaysApplyTransformations;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getAlwaysApplyTransformations()
    {
        return $this->alwaysApplyTransformations;
    }

    /**
     * @param boolean $rtpEncryption
     *
     * @return static
     */
    public function setRtpEncryption($rtpEncryption = null)
    {
        $this->rtpEncryption = $rtpEncryption;

        return $this;
    }

    /**
     * @return boolean | null
     */
    public function getRtpEncryption()
    {
        return $this->rtpEncryption;
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
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainDto $domain
     *
     * @return static
     */
    public function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainDto $domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainDto | null
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setDomainId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Domain\DomainDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto $transformationRuleSet
     *
     * @return static
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto $transformationRuleSet = null)
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto | null
     */
    public function getTransformationRuleSet()
    {
        return $this->transformationRuleSet;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setTransformationRuleSetId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\CallAcl\CallAclDto $callAcl
     *
     * @return static
     */
    public function setCallAcl(\Ivoz\Provider\Domain\Model\CallAcl\CallAclDto $callAcl = null)
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAclDto | null
     */
    public function getCallAcl()
    {
        return $this->callAcl;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setCallAclId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\CallAcl\CallAclDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiDto $outgoingDdi
     *
     * @return static
     */
    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiDto $outgoingDdi = null)
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiDto | null
     */
    public function getOutgoingDdi()
    {
        return $this->outgoingDdi;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setOutgoingDdiId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Ddi\DdiDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageDto $language
     *
     * @return static
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageDto $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageDto | null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setLanguageId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Language\LanguageDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $interCompany
     *
     * @return static
     */
    public function setInterCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $interCompany = null)
    {
        $this->interCompany = $interCompany;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    public function getInterCompany()
    {
        return $this->interCompany;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setInterCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
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
     * @param array $psEndpoints
     *
     * @return static
     */
    public function setPsEndpoints($psEndpoints = null)
    {
        $this->psEndpoints = $psEndpoints;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getPsEndpoints()
    {
        return $this->psEndpoints;
    }

    /**
     * @param array $patterns
     *
     * @return static
     */
    public function setPatterns($patterns = null)
    {
        $this->patterns = $patterns;

        return $this;
    }

    /**
     * @return array | null
     */
    public function getPatterns()
    {
        return $this->patterns;
    }
}
