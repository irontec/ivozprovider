<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Friend;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet;
use Ivoz\Provider\Domain\Model\CallAcl\CallAcl;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Language\Language;

/**
* FriendAbstract
* @codeCoverageIgnore
*/
abstract class FriendAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * comment: enum:udp|tcp|tls
     * @var string | null
     */
    protected $transport;

    /**
     * @var string | null
     */
    protected $ip;

    /**
     * @var int | null
     */
    protected $port;

    /**
     * @var string | null
     */
    protected $password;

    /**
     * @var int
     */
    protected $priority = 1;

    /**
     * @var string
     */
    protected $disallow = 'all';

    /**
     * @var string
     */
    protected $allow = 'alaw';

    /**
     * column: direct_media_method
     * comment: enum:invite|update
     * @var string
     */
    protected $directMediaMethod = 'update';

    /**
     * column: callerid_update_header
     * comment: enum:pai|rpid
     * @var string
     */
    protected $calleridUpdateHeader = 'pai';

    /**
     * column: update_callerid
     * comment: enum:yes|no
     * @var string
     */
    protected $updateCallerid = 'yes';

    /**
     * column: from_user
     * @var string | null
     */
    protected $fromUser;

    /**
     * column: from_domain
     * @var string | null
     */
    protected $fromDomain;

    /**
     * comment: enum:yes|no|intervpbx
     * @var string
     */
    protected $directConnectivity = 'yes';

    /**
     * comment: enum:yes|no
     * @var string
     */
    protected $ddiIn = 'yes';

    /**
     * comment: enum:yes|no
     * @var string
     */
    protected $t38Passthrough = 'no';

    /**
     * @var bool
     */
    protected $alwaysApplyTransformations = false;

    /**
     * @var bool
     */
    protected $rtpEncryption = false;

    /**
     * @var boolean
     */
    protected $multiContact = true;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var DomainInterface
     * inversedBy friends
     */
    protected $domain;

    /**
     * @var TransformationRuleSetInterface
     */
    protected $transformationRuleSet;

    /**
     * @var CallAclInterface
     */
    protected $callAcl;

    /**
     * @var DdiInterface
     */
    protected $outgoingDdi;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var CompanyInterface
     */
    protected $interCompany;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $description,
        $priority,
        $disallow,
        $allow,
        $directMediaMethod,
        $calleridUpdateHeader,
        $updateCallerid,
        $directConnectivity,
        $ddiIn,
        $t38Passthrough,
        $alwaysApplyTransformations,
        $rtpEncryption,
        $multiContact
    ) {
        $this->setName($name);
        $this->setDescription($description);
        $this->setPriority($priority);
        $this->setDisallow($disallow);
        $this->setAllow($allow);
        $this->setDirectMediaMethod($directMediaMethod);
        $this->setCalleridUpdateHeader($calleridUpdateHeader);
        $this->setUpdateCallerid($updateCallerid);
        $this->setDirectConnectivity($directConnectivity);
        $this->setDdiIn($ddiIn);
        $this->setT38Passthrough($t38Passthrough);
        $this->setAlwaysApplyTransformations($alwaysApplyTransformations);
        $this->setRtpEncryption($rtpEncryption);
        $this->setMultiContact($multiContact);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Friend",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return FriendDto
     */
    public static function createDto($id = null)
    {
        return new FriendDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param FriendInterface|null $entity
     * @param int $depth
     * @return FriendDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, FriendInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var FriendDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FriendDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FriendDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getDescription(),
            $dto->getPriority(),
            $dto->getDisallow(),
            $dto->getAllow(),
            $dto->getDirectMediaMethod(),
            $dto->getCalleridUpdateHeader(),
            $dto->getUpdateCallerid(),
            $dto->getDirectConnectivity(),
            $dto->getDdiIn(),
            $dto->getT38Passthrough(),
            $dto->getAlwaysApplyTransformations(),
            $dto->getRtpEncryption(),
            $dto->getMultiContact()
        );

        $self
            ->setTransport($dto->getTransport())
            ->setIp($dto->getIp())
            ->setPort($dto->getPort())
            ->setPassword($dto->getPassword())
            ->setFromUser($dto->getFromUser())
            ->setFromDomain($dto->getFromDomain())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setCallAcl($fkTransformer->transform($dto->getCallAcl()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setInterCompany($fkTransformer->transform($dto->getInterCompany()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FriendDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FriendDto::class);

        $this
            ->setName($dto->getName())
            ->setDescription($dto->getDescription())
            ->setTransport($dto->getTransport())
            ->setIp($dto->getIp())
            ->setPort($dto->getPort())
            ->setPassword($dto->getPassword())
            ->setPriority($dto->getPriority())
            ->setDisallow($dto->getDisallow())
            ->setAllow($dto->getAllow())
            ->setDirectMediaMethod($dto->getDirectMediaMethod())
            ->setCalleridUpdateHeader($dto->getCalleridUpdateHeader())
            ->setUpdateCallerid($dto->getUpdateCallerid())
            ->setFromUser($dto->getFromUser())
            ->setFromDomain($dto->getFromDomain())
            ->setDirectConnectivity($dto->getDirectConnectivity())
            ->setDdiIn($dto->getDdiIn())
            ->setT38Passthrough($dto->getT38Passthrough())
            ->setAlwaysApplyTransformations($dto->getAlwaysApplyTransformations())
            ->setRtpEncryption($dto->getRtpEncryption())
            ->setMultiContact($dto->getMultiContact())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setCallAcl($fkTransformer->transform($dto->getCallAcl()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
            ->setInterCompany($fkTransformer->transform($dto->getInterCompany()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return FriendDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDescription(self::getDescription())
            ->setTransport(self::getTransport())
            ->setIp(self::getIp())
            ->setPort(self::getPort())
            ->setPassword(self::getPassword())
            ->setPriority(self::getPriority())
            ->setDisallow(self::getDisallow())
            ->setAllow(self::getAllow())
            ->setDirectMediaMethod(self::getDirectMediaMethod())
            ->setCalleridUpdateHeader(self::getCalleridUpdateHeader())
            ->setUpdateCallerid(self::getUpdateCallerid())
            ->setFromUser(self::getFromUser())
            ->setFromDomain(self::getFromDomain())
            ->setDirectConnectivity(self::getDirectConnectivity())
            ->setDdiIn(self::getDdiIn())
            ->setT38Passthrough(self::getT38Passthrough())
            ->setAlwaysApplyTransformations(self::getAlwaysApplyTransformations())
            ->setRtpEncryption(self::getRtpEncryption())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setDomain(Domain::entityToDto(self::getDomain(), $depth))
            ->setTransformationRuleSet(TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth))
            ->setCallAcl(CallAcl::entityToDto(self::getCallAcl(), $depth))
            ->setOutgoingDdi(Ddi::entityToDto(self::getOutgoingDdi(), $depth))
            ->setLanguage(Language::entityToDto(self::getLanguage(), $depth))
            ->setInterCompany(Company::entityToDto(self::getInterCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'description' => self::getDescription(),
            'transport' => self::getTransport(),
            'ip' => self::getIp(),
            'port' => self::getPort(),
            'password' => self::getPassword(),
            'priority' => self::getPriority(),
            'disallow' => self::getDisallow(),
            'allow' => self::getAllow(),
            'direct_media_method' => self::getDirectMediaMethod(),
            'callerid_update_header' => self::getCalleridUpdateHeader(),
            'update_callerid' => self::getUpdateCallerid(),
            'from_user' => self::getFromUser(),
            'from_domain' => self::getFromDomain(),
            'directConnectivity' => self::getDirectConnectivity(),
            'ddiIn' => self::getDdiIn(),
            't38Passthrough' => self::getT38Passthrough(),
            'alwaysApplyTransformations' => self::getAlwaysApplyTransformations(),
            'rtpEncryption' => self::getRtpEncryption(),
            'multiContact' => self::getMultiContact(),
            'companyId' => self::getCompany()->getId(),
            'domainId' => self::getDomain() ? self::getDomain()->getId() : null,
            'transformationRuleSetId' => self::getTransformationRuleSet() ? self::getTransformationRuleSet()->getId() : null,
            'callAclId' => self::getCallAcl() ? self::getCallAcl()->getId() : null,
            'outgoingDdiId' => self::getOutgoingDdi() ? self::getOutgoingDdi()->getId() : null,
            'languageId' => self::getLanguage() ? self::getLanguage()->getId() : null,
            'interCompanyId' => self::getInterCompany() ? self::getInterCompany()->getId() : null
        ];
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): FriendInterface
    {
        Assertion::maxLength($name, 65, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return static
     */
    protected function setDescription(string $description): FriendInterface
    {
        Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set transport
     *
     * @param string $transport | null
     *
     * @return static
     */
    protected function setTransport(?string $transport = null): FriendInterface
    {
        if (!is_null($transport)) {
            Assertion::maxLength($transport, 25, 'transport value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $transport,
                [
                    FriendInterface::TRANSPORT_UDP,
                    FriendInterface::TRANSPORT_TCP,
                    FriendInterface::TRANSPORT_TLS,
                ],
                'transportvalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->transport = $transport;

        return $this;
    }

    /**
     * Get transport
     *
     * @return string | null
     */
    public function getTransport(): ?string
    {
        return $this->transport;
    }

    /**
     * Set ip
     *
     * @param string $ip | null
     *
     * @return static
     */
    protected function setIp(?string $ip = null): FriendInterface
    {
        if (!is_null($ip)) {
            Assertion::maxLength($ip, 50, 'ip value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string | null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * Set port
     *
     * @param int $port | null
     *
     * @return static
     */
    protected function setPort(?int $port = null): FriendInterface
    {
        if (!is_null($port)) {
            Assertion::greaterOrEqualThan($port, 0, 'port provided "%s" is not greater or equal than "%s".');
        }

        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return int | null
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * Set password
     *
     * @param string $password | null
     *
     * @return static
     */
    protected function setPassword(?string $password = null): FriendInterface
    {
        if (!is_null($password)) {
            Assertion::maxLength($password, 64, 'password value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string | null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set priority
     *
     * @param int $priority
     *
     * @return static
     */
    protected function setPriority(int $priority): FriendInterface
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Set disallow
     *
     * @param string $disallow
     *
     * @return static
     */
    protected function setDisallow(string $disallow): FriendInterface
    {
        Assertion::maxLength($disallow, 200, 'disallow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->disallow = $disallow;

        return $this;
    }

    /**
     * Get disallow
     *
     * @return string
     */
    public function getDisallow(): string
    {
        return $this->disallow;
    }

    /**
     * Set allow
     *
     * @param string $allow
     *
     * @return static
     */
    protected function setAllow(string $allow): FriendInterface
    {
        Assertion::maxLength($allow, 200, 'allow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->allow = $allow;

        return $this;
    }

    /**
     * Get allow
     *
     * @return string
     */
    public function getAllow(): string
    {
        return $this->allow;
    }

    /**
     * Set directMediaMethod
     *
     * @param string $directMediaMethod
     *
     * @return static
     */
    protected function setDirectMediaMethod(string $directMediaMethod): FriendInterface
    {
        Assertion::choice(
            $directMediaMethod,
            [
                FriendInterface::DIRECTMEDIAMETHOD_INVITE,
                FriendInterface::DIRECTMEDIAMETHOD_UPDATE,
            ],
            'directMediaMethodvalue "%s" is not an element of the valid values: %s'
        );

        $this->directMediaMethod = $directMediaMethod;

        return $this;
    }

    /**
     * Get directMediaMethod
     *
     * @return string
     */
    public function getDirectMediaMethod(): string
    {
        return $this->directMediaMethod;
    }

    /**
     * Set calleridUpdateHeader
     *
     * @param string $calleridUpdateHeader
     *
     * @return static
     */
    protected function setCalleridUpdateHeader(string $calleridUpdateHeader): FriendInterface
    {
        Assertion::choice(
            $calleridUpdateHeader,
            [
                FriendInterface::CALLERIDUPDATEHEADER_PAI,
                FriendInterface::CALLERIDUPDATEHEADER_RPID,
            ],
            'calleridUpdateHeadervalue "%s" is not an element of the valid values: %s'
        );

        $this->calleridUpdateHeader = $calleridUpdateHeader;

        return $this;
    }

    /**
     * Get calleridUpdateHeader
     *
     * @return string
     */
    public function getCalleridUpdateHeader(): string
    {
        return $this->calleridUpdateHeader;
    }

    /**
     * Set updateCallerid
     *
     * @param string $updateCallerid
     *
     * @return static
     */
    protected function setUpdateCallerid(string $updateCallerid): FriendInterface
    {
        Assertion::choice(
            $updateCallerid,
            [
                FriendInterface::UPDATECALLERID_YES,
                FriendInterface::UPDATECALLERID_NO,
            ],
            'updateCalleridvalue "%s" is not an element of the valid values: %s'
        );

        $this->updateCallerid = $updateCallerid;

        return $this;
    }

    /**
     * Get updateCallerid
     *
     * @return string
     */
    public function getUpdateCallerid(): string
    {
        return $this->updateCallerid;
    }

    /**
     * Set fromUser
     *
     * @param string $fromUser | null
     *
     * @return static
     */
    protected function setFromUser(?string $fromUser = null): FriendInterface
    {
        if (!is_null($fromUser)) {
            Assertion::maxLength($fromUser, 190, 'fromUser value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromUser = $fromUser;

        return $this;
    }

    /**
     * Get fromUser
     *
     * @return string | null
     */
    public function getFromUser(): ?string
    {
        return $this->fromUser;
    }

    /**
     * Set fromDomain
     *
     * @param string $fromDomain | null
     *
     * @return static
     */
    protected function setFromDomain(?string $fromDomain = null): FriendInterface
    {
        if (!is_null($fromDomain)) {
            Assertion::maxLength($fromDomain, 190, 'fromDomain value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fromDomain = $fromDomain;

        return $this;
    }

    /**
     * Get fromDomain
     *
     * @return string | null
     */
    public function getFromDomain(): ?string
    {
        return $this->fromDomain;
    }

    /**
     * Set directConnectivity
     *
     * @param string $directConnectivity
     *
     * @return static
     */
    protected function setDirectConnectivity(string $directConnectivity): FriendInterface
    {
        Assertion::maxLength($directConnectivity, 20, 'directConnectivity value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $directConnectivity,
            [
                FriendInterface::DIRECTCONNECTIVITY_YES,
                FriendInterface::DIRECTCONNECTIVITY_NO,
                FriendInterface::DIRECTCONNECTIVITY_INTERVPBX,
            ],
            'directConnectivityvalue "%s" is not an element of the valid values: %s'
        );

        $this->directConnectivity = $directConnectivity;

        return $this;
    }

    /**
     * Get directConnectivity
     *
     * @return string
     */
    public function getDirectConnectivity(): string
    {
        return $this->directConnectivity;
    }

    /**
     * Set ddiIn
     *
     * @param string $ddiIn
     *
     * @return static
     */
    protected function setDdiIn(string $ddiIn): FriendInterface
    {
        Assertion::choice(
            $ddiIn,
            [
                FriendInterface::DDIIN_YES,
                FriendInterface::DDIIN_NO,
            ],
            'ddiInvalue "%s" is not an element of the valid values: %s'
        );

        $this->ddiIn = $ddiIn;

        return $this;
    }

    /**
     * Get ddiIn
     *
     * @return string
     */
    public function getDdiIn(): string
    {
        return $this->ddiIn;
    }

    /**
     * Set t38Passthrough
     *
     * @param string $t38Passthrough
     *
     * @return static
     */
    protected function setT38Passthrough(string $t38Passthrough): FriendInterface
    {
        Assertion::choice(
            $t38Passthrough,
            [
                FriendInterface::T38PASSTHROUGH_YES,
                FriendInterface::T38PASSTHROUGH_NO,
            ],
            't38Passthroughvalue "%s" is not an element of the valid values: %s'
        );

        $this->t38Passthrough = $t38Passthrough;

        return $this;
    }

    /**
     * Get t38Passthrough
     *
     * @return string
     */
    public function getT38Passthrough(): string
    {
        return $this->t38Passthrough;
    }

    /**
     * Set alwaysApplyTransformations
     *
     * @param bool $alwaysApplyTransformations
     *
     * @return static
     */
    protected function setAlwaysApplyTransformations(bool $alwaysApplyTransformations): FriendInterface
    {
        Assertion::between(intval($alwaysApplyTransformations), 0, 1, 'alwaysApplyTransformations provided "%s" is not a valid boolean value.');
        $alwaysApplyTransformations = (bool) $alwaysApplyTransformations;

        $this->alwaysApplyTransformations = $alwaysApplyTransformations;

        return $this;
    }

    /**
     * Get alwaysApplyTransformations
     *
     * @return bool
     */
    public function getAlwaysApplyTransformations(): bool
    {
        return $this->alwaysApplyTransformations;
    }

    /**
     * Set rtpEncryption
     *
     * @param bool $rtpEncryption
     *
     * @return static
     */
    protected function setRtpEncryption(bool $rtpEncryption): FriendInterface
    {
        Assertion::between(intval($rtpEncryption), 0, 1, 'rtpEncryption provided "%s" is not a valid boolean value.');
        $rtpEncryption = (bool) $rtpEncryption;

        $this->rtpEncryption = $rtpEncryption;

        return $this;
    }

    /**
     * Get rtpEncryption
     *
     * @return bool
     */
    public function getRtpEncryption(): bool
    {
        return $this->rtpEncryption;
    }

    /**
     * Set multiContact
     *
     * @param boolean $multiContact
     *
     * @return static
     */
    protected function setMultiContact($multiContact)
    {
        Assertion::notNull($multiContact, 'multiContact value "%s" is null, but non null value was expected.');
        Assertion::between(intval($multiContact), 0, 1, 'multiContact provided "%s" is not a valid boolean value.');
        $multiContact = (bool) $multiContact;

        $this->multiContact = $multiContact;

        return $this;
    }

    /**
     * Get multiContact
     *
     * @return boolean
     */
    public function getMultiContact(): bool
    {
        return $this->multiContact;
    }

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    public function setCompany(CompanyInterface $company): FriendInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    /**
     * Set domain
     *
     * @param DomainInterface | null
     *
     * @return static
     */
    public function setDomain(?DomainInterface $domain = null): FriendInterface
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return DomainInterface | null
     */
    public function getDomain(): ?DomainInterface
    {
        return $this->domain;
    }

    /**
     * Set transformationRuleSet
     *
     * @param TransformationRuleSetInterface | null
     *
     * @return static
     */
    protected function setTransformationRuleSet(?TransformationRuleSetInterface $transformationRuleSet = null): FriendInterface
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * Get transformationRuleSet
     *
     * @return TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetInterface
    {
        return $this->transformationRuleSet;
    }

    /**
     * Set callAcl
     *
     * @param CallAclInterface | null
     *
     * @return static
     */
    protected function setCallAcl(?CallAclInterface $callAcl = null): FriendInterface
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    /**
     * Get callAcl
     *
     * @return CallAclInterface | null
     */
    public function getCallAcl(): ?CallAclInterface
    {
        return $this->callAcl;
    }

    /**
     * Set outgoingDdi
     *
     * @param DdiInterface | null
     *
     * @return static
     */
    protected function setOutgoingDdi(?DdiInterface $outgoingDdi = null): FriendInterface
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * Get outgoingDdi
     *
     * @return DdiInterface | null
     */
    public function getOutgoingDdi(): ?DdiInterface
    {
        return $this->outgoingDdi;
    }

    /**
     * Set language
     *
     * @param LanguageInterface | null
     *
     * @return static
     */
    protected function setLanguage(?LanguageInterface $language = null): FriendInterface
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return LanguageInterface | null
     */
    public function getLanguage(): ?LanguageInterface
    {
        return $this->language;
    }

    /**
     * Set interCompany
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    protected function setInterCompany(?CompanyInterface $interCompany = null): FriendInterface
    {
        $this->interCompany = $interCompany;

        return $this;
    }

    /**
     * Get interCompany
     *
     * @return CompanyInterface | null
     */
    public function getInterCompany(): ?CompanyInterface
    {
        return $this->interCompany;
    }

}
