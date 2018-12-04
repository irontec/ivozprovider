<?php

namespace Ivoz\Provider\Domain\Model\ResidentialDevice;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * ResidentialDeviceAbstract
 * @codeCoverageIgnore
 */
abstract class ResidentialDeviceAbstract
{
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
     * @var string
     */
    protected $transport;

    /**
     * @var string | null
     */
    protected $ip;

    /**
     * @var integer | null
     */
    protected $port;

    /**
     * column: auth_needed
     * @var string
     */
    protected $authNeeded = 'yes';

    /**
     * @var string | null
     */
    protected $password;

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
     * column: from_domain
     * @var string | null
     */
    protected $fromDomain;

    /**
     * comment: enum:yes|no
     * @var string
     */
    protected $directConnectivity = 'yes';

    /**
     * comment: enum:yes|no
     * @var string
     */
    protected $ddiIn = 'yes';

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Domain\DomainInterface
     */
    protected $domain;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface
     */
    protected $transformationRuleSet;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    protected $outgoingDdi;

    /**
     * @var \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    protected $language;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $description,
        $transport,
        $authNeeded,
        $disallow,
        $allow,
        $directMediaMethod,
        $calleridUpdateHeader,
        $updateCallerid,
        $directConnectivity,
        $ddiIn
    ) {
        $this->setName($name);
        $this->setDescription($description);
        $this->setTransport($transport);
        $this->setAuthNeeded($authNeeded);
        $this->setDisallow($disallow);
        $this->setAllow($allow);
        $this->setDirectMediaMethod($directMediaMethod);
        $this->setCalleridUpdateHeader($calleridUpdateHeader);
        $this->setUpdateCallerid($updateCallerid);
        $this->setDirectConnectivity($directConnectivity);
        $this->setDdiIn($ddiIn);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "ResidentialDevice",
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
     * @return ResidentialDeviceDto
     */
    public static function createDto($id = null)
    {
        return new ResidentialDeviceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return ResidentialDeviceDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ResidentialDeviceInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto ResidentialDeviceDto
         */
        Assertion::isInstanceOf($dto, ResidentialDeviceDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getDescription(),
            $dto->getTransport(),
            $dto->getAuthNeeded(),
            $dto->getDisallow(),
            $dto->getAllow(),
            $dto->getDirectMediaMethod(),
            $dto->getCalleridUpdateHeader(),
            $dto->getUpdateCallerid(),
            $dto->getDirectConnectivity(),
            $dto->getDdiIn()
        );

        $self
            ->setIp($dto->getIp())
            ->setPort($dto->getPort())
            ->setPassword($dto->getPassword())
            ->setFromDomain($dto->getFromDomain())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()))
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto ResidentialDeviceDto
         */
        Assertion::isInstanceOf($dto, ResidentialDeviceDto::class);

        $this
            ->setName($dto->getName())
            ->setDescription($dto->getDescription())
            ->setTransport($dto->getTransport())
            ->setIp($dto->getIp())
            ->setPort($dto->getPort())
            ->setAuthNeeded($dto->getAuthNeeded())
            ->setPassword($dto->getPassword())
            ->setDisallow($dto->getDisallow())
            ->setAllow($dto->getAllow())
            ->setDirectMediaMethod($dto->getDirectMediaMethod())
            ->setCalleridUpdateHeader($dto->getCalleridUpdateHeader())
            ->setUpdateCallerid($dto->getUpdateCallerid())
            ->setFromDomain($dto->getFromDomain())
            ->setDirectConnectivity($dto->getDirectConnectivity())
            ->setDdiIn($dto->getDdiIn())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setTransformationRuleSet($fkTransformer->transform($dto->getTransformationRuleSet()))
            ->setOutgoingDdi($fkTransformer->transform($dto->getOutgoingDdi()))
            ->setLanguage($fkTransformer->transform($dto->getLanguage()));



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ResidentialDeviceDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDescription(self::getDescription())
            ->setTransport(self::getTransport())
            ->setIp(self::getIp())
            ->setPort(self::getPort())
            ->setAuthNeeded(self::getAuthNeeded())
            ->setPassword(self::getPassword())
            ->setDisallow(self::getDisallow())
            ->setAllow(self::getAllow())
            ->setDirectMediaMethod(self::getDirectMediaMethod())
            ->setCalleridUpdateHeader(self::getCalleridUpdateHeader())
            ->setUpdateCallerid(self::getUpdateCallerid())
            ->setFromDomain(self::getFromDomain())
            ->setDirectConnectivity(self::getDirectConnectivity())
            ->setDdiIn(self::getDdiIn())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setDomain(\Ivoz\Provider\Domain\Model\Domain\Domain::entityToDto(self::getDomain(), $depth))
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSet::entityToDto(self::getTransformationRuleSet(), $depth))
            ->setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\Ddi::entityToDto(self::getOutgoingDdi(), $depth))
            ->setLanguage(\Ivoz\Provider\Domain\Model\Language\Language::entityToDto(self::getLanguage(), $depth));
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
            'auth_needed' => self::getAuthNeeded(),
            'password' => self::getPassword(),
            'disallow' => self::getDisallow(),
            'allow' => self::getAllow(),
            'direct_media_method' => self::getDirectMediaMethod(),
            'callerid_update_header' => self::getCalleridUpdateHeader(),
            'update_callerid' => self::getUpdateCallerid(),
            'from_domain' => self::getFromDomain(),
            'directConnectivity' => self::getDirectConnectivity(),
            'ddiIn' => self::getDdiIn(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'domainId' => self::getDomain() ? self::getDomain()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'transformationRuleSetId' => self::getTransformationRuleSet() ? self::getTransformationRuleSet()->getId() : null,
            'outgoingDdiId' => self::getOutgoingDdi() ? self::getOutgoingDdi()->getId() : null,
            'languageId' => self::getLanguage() ? self::getLanguage()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    protected function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 65, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    protected function setDescription($description)
    {
        Assertion::notNull($description, 'description value "%s" is null, but non null value was expected.');
        Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set transport
     *
     * @param string $transport
     *
     * @return self
     */
    protected function setTransport($transport)
    {
        Assertion::notNull($transport, 'transport value "%s" is null, but non null value was expected.');
        Assertion::maxLength($transport, 25, 'transport value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($transport, array (
          0 => 'udp',
          1 => 'tcp',
          2 => 'tls',
        ), 'transportvalue "%s" is not an element of the valid values: %s');

        $this->transport = $transport;

        return $this;
    }

    /**
     * Get transport
     *
     * @return string
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return self
     */
    protected function setIp($ip = null)
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
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set port
     *
     * @param integer $port
     *
     * @return self
     */
    protected function setPort($port = null)
    {
        if (!is_null($port)) {
            if (!is_null($port)) {
                Assertion::integerish($port, 'port value "%s" is not an integer or a number castable to integer.');
                Assertion::greaterOrEqualThan($port, 0, 'port provided "%s" is not greater or equal than "%s".');
            }
        }

        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return integer | null
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set authNeeded
     *
     * @param string $authNeeded
     *
     * @return self
     */
    protected function setAuthNeeded($authNeeded)
    {
        Assertion::notNull($authNeeded, 'authNeeded value "%s" is null, but non null value was expected.');

        $this->authNeeded = $authNeeded;

        return $this;
    }

    /**
     * Get authNeeded
     *
     * @return string
     */
    public function getAuthNeeded()
    {
        return $this->authNeeded;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return self
     */
    protected function setPassword($password = null)
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set disallow
     *
     * @param string $disallow
     *
     * @return self
     */
    protected function setDisallow($disallow)
    {
        Assertion::notNull($disallow, 'disallow value "%s" is null, but non null value was expected.');
        Assertion::maxLength($disallow, 200, 'disallow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->disallow = $disallow;

        return $this;
    }

    /**
     * Get disallow
     *
     * @return string
     */
    public function getDisallow()
    {
        return $this->disallow;
    }

    /**
     * Set allow
     *
     * @param string $allow
     *
     * @return self
     */
    protected function setAllow($allow)
    {
        Assertion::notNull($allow, 'allow value "%s" is null, but non null value was expected.');
        Assertion::maxLength($allow, 200, 'allow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->allow = $allow;

        return $this;
    }

    /**
     * Get allow
     *
     * @return string
     */
    public function getAllow()
    {
        return $this->allow;
    }

    /**
     * Set directMediaMethod
     *
     * @param string $directMediaMethod
     *
     * @return self
     */
    protected function setDirectMediaMethod($directMediaMethod)
    {
        Assertion::notNull($directMediaMethod, 'directMediaMethod value "%s" is null, but non null value was expected.');
        Assertion::choice($directMediaMethod, array (
          0 => 'invite',
          1 => 'update',
        ), 'directMediaMethodvalue "%s" is not an element of the valid values: %s');

        $this->directMediaMethod = $directMediaMethod;

        return $this;
    }

    /**
     * Get directMediaMethod
     *
     * @return string
     */
    public function getDirectMediaMethod()
    {
        return $this->directMediaMethod;
    }

    /**
     * Set calleridUpdateHeader
     *
     * @param string $calleridUpdateHeader
     *
     * @return self
     */
    protected function setCalleridUpdateHeader($calleridUpdateHeader)
    {
        Assertion::notNull($calleridUpdateHeader, 'calleridUpdateHeader value "%s" is null, but non null value was expected.');
        Assertion::choice($calleridUpdateHeader, array (
          0 => 'pai',
          1 => 'rpid',
        ), 'calleridUpdateHeadervalue "%s" is not an element of the valid values: %s');

        $this->calleridUpdateHeader = $calleridUpdateHeader;

        return $this;
    }

    /**
     * Get calleridUpdateHeader
     *
     * @return string
     */
    public function getCalleridUpdateHeader()
    {
        return $this->calleridUpdateHeader;
    }

    /**
     * Set updateCallerid
     *
     * @param string $updateCallerid
     *
     * @return self
     */
    protected function setUpdateCallerid($updateCallerid)
    {
        Assertion::notNull($updateCallerid, 'updateCallerid value "%s" is null, but non null value was expected.');
        Assertion::choice($updateCallerid, array (
          0 => 'yes',
          1 => 'no',
        ), 'updateCalleridvalue "%s" is not an element of the valid values: %s');

        $this->updateCallerid = $updateCallerid;

        return $this;
    }

    /**
     * Get updateCallerid
     *
     * @return string
     */
    public function getUpdateCallerid()
    {
        return $this->updateCallerid;
    }

    /**
     * Set fromDomain
     *
     * @param string $fromDomain
     *
     * @return self
     */
    protected function setFromDomain($fromDomain = null)
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
    public function getFromDomain()
    {
        return $this->fromDomain;
    }

    /**
     * Set directConnectivity
     *
     * @param string $directConnectivity
     *
     * @return self
     */
    protected function setDirectConnectivity($directConnectivity)
    {
        Assertion::notNull($directConnectivity, 'directConnectivity value "%s" is null, but non null value was expected.');
        Assertion::choice($directConnectivity, array (
          0 => 'yes',
          1 => 'no',
        ), 'directConnectivityvalue "%s" is not an element of the valid values: %s');

        $this->directConnectivity = $directConnectivity;

        return $this;
    }

    /**
     * Get directConnectivity
     *
     * @return string
     */
    public function getDirectConnectivity()
    {
        return $this->directConnectivity;
    }

    /**
     * Set ddiIn
     *
     * @param string $ddiIn
     *
     * @return self
     */
    protected function setDdiIn($ddiIn)
    {
        Assertion::notNull($ddiIn, 'ddiIn value "%s" is null, but non null value was expected.');
        Assertion::choice($ddiIn, array (
          0 => 'yes',
          1 => 'no',
        ), 'ddiInvalue "%s" is not an element of the valid values: %s');

        $this->ddiIn = $ddiIn;

        return $this;
    }

    /**
     * Get ddiIn
     *
     * @return string
     */
    public function getDdiIn()
    {
        return $this->ddiIn;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set domain
     *
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain
     *
     * @return self
     */
    public function setDomain(\Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set transformationRuleSet
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet
     *
     * @return self
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet = null)
    {
        $this->transformationRuleSet = $transformationRuleSet;

        return $this;
    }

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface
     */
    public function getTransformationRuleSet()
    {
        return $this->transformationRuleSet;
    }

    /**
     * Set outgoingDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi
     *
     * @return self
     */
    public function setOutgoingDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $outgoingDdi = null)
    {
        $this->outgoingDdi = $outgoingDdi;

        return $this;
    }

    /**
     * Get outgoingDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi()
    {
        return $this->outgoingDdi;
    }

    /**
     * Set language
     *
     * @param \Ivoz\Provider\Domain\Model\Language\LanguageInterface $language
     *
     * @return self
     */
    public function setLanguage(\Ivoz\Provider\Domain\Model\Language\LanguageInterface $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Ivoz\Provider\Domain\Model\Language\LanguageInterface
     */
    public function getLanguage()
    {
        return $this->language;
    }

    // @codeCoverageIgnoreEnd
}
