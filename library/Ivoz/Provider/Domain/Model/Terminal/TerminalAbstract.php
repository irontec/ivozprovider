<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TerminalAbstract
 * @codeCoverageIgnore
 */
abstract class TerminalAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $disallow = 'all';

    /**
     * column: allow_audio
     * @var string
     */
    protected $allowAudio = 'alaw';

    /**
     * column: allow_video
     * @var string
     */
    protected $allowVideo;

    /**
     * column: direct_media_method
     * comment: enum:update|invite|reinvite
     * @var string
     */
    protected $directMediaMethod = 'update';

    /**
     * comment: password
     * @var string
     */
    protected $password = '';

    /**
     * @var string
     */
    protected $mac;

    /**
     * @var \DateTime
     */
    protected $lastProvisionDate;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Domain\DomainInterface
     */
    protected $domain;

    /**
     * @var \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface
     */
    protected $terminalModel;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $disallow,
        $allowAudio,
        $directMediaMethod,
        $password
    ) {
        $this->setDisallow($disallow);
        $this->setAllowAudio($allowAudio);
        $this->setDirectMediaMethod($directMediaMethod);
        $this->setPassword($password);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Terminal",
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
     * @return TerminalDto
     */
    public static function createDto($id = null)
    {
        return new TerminalDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TerminalDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TerminalInterface::class);

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
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TerminalDto
         */
        Assertion::isInstanceOf($dto, TerminalDto::class);

        $self = new static(
            $dto->getDisallow(),
            $dto->getAllowAudio(),
            $dto->getDirectMediaMethod(),
            $dto->getPassword()
        );

        $self
            ->setName($dto->getName())
            ->setAllowVideo($dto->getAllowVideo())
            ->setMac($dto->getMac())
            ->setLastProvisionDate($dto->getLastProvisionDate())
            ->setCompany($dto->getCompany())
            ->setDomain($dto->getDomain())
            ->setTerminalModel($dto->getTerminalModel())
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
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TerminalDto
         */
        Assertion::isInstanceOf($dto, TerminalDto::class);

        $this
            ->setName($dto->getName())
            ->setDisallow($dto->getDisallow())
            ->setAllowAudio($dto->getAllowAudio())
            ->setAllowVideo($dto->getAllowVideo())
            ->setDirectMediaMethod($dto->getDirectMediaMethod())
            ->setPassword($dto->getPassword())
            ->setMac($dto->getMac())
            ->setLastProvisionDate($dto->getLastProvisionDate())
            ->setCompany($dto->getCompany())
            ->setDomain($dto->getDomain())
            ->setTerminalModel($dto->getTerminalModel());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TerminalDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDisallow(self::getDisallow())
            ->setAllowAudio(self::getAllowAudio())
            ->setAllowVideo(self::getAllowVideo())
            ->setDirectMediaMethod(self::getDirectMediaMethod())
            ->setPassword(self::getPassword())
            ->setMac(self::getMac())
            ->setLastProvisionDate(self::getLastProvisionDate())
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setDomain(\Ivoz\Provider\Domain\Model\Domain\Domain::entityToDto(self::getDomain(), $depth))
            ->setTerminalModel(\Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel::entityToDto(self::getTerminalModel(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'disallow' => self::getDisallow(),
            'allow_audio' => self::getAllowAudio(),
            'allow_video' => self::getAllowVideo(),
            'direct_media_method' => self::getDirectMediaMethod(),
            'password' => self::getPassword(),
            'mac' => self::getMac(),
            'lastProvisionDate' => self::getLastProvisionDate(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'domainId' => self::getDomain() ? self::getDomain()->getId() : null,
            'terminalModelId' => self::getTerminalModel() ? self::getTerminalModel()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * @deprecated
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name = null)
    {
        if (!is_null($name)) {
            Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

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
     * @deprecated
     * Set disallow
     *
     * @param string $disallow
     *
     * @return self
     */
    public function setDisallow($disallow)
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
     * @deprecated
     * Set allowAudio
     *
     * @param string $allowAudio
     *
     * @return self
     */
    public function setAllowAudio($allowAudio)
    {
        Assertion::notNull($allowAudio, 'allowAudio value "%s" is null, but non null value was expected.');
        Assertion::maxLength($allowAudio, 200, 'allowAudio value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->allowAudio = $allowAudio;

        return $this;
    }

    /**
     * Get allowAudio
     *
     * @return string
     */
    public function getAllowAudio()
    {
        return $this->allowAudio;
    }

    /**
     * @deprecated
     * Set allowVideo
     *
     * @param string $allowVideo
     *
     * @return self
     */
    public function setAllowVideo($allowVideo = null)
    {
        if (!is_null($allowVideo)) {
            Assertion::maxLength($allowVideo, 200, 'allowVideo value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->allowVideo = $allowVideo;

        return $this;
    }

    /**
     * Get allowVideo
     *
     * @return string
     */
    public function getAllowVideo()
    {
        return $this->allowVideo;
    }

    /**
     * @deprecated
     * Set directMediaMethod
     *
     * @param string $directMediaMethod
     *
     * @return self
     */
    public function setDirectMediaMethod($directMediaMethod)
    {
        Assertion::notNull($directMediaMethod, 'directMediaMethod value "%s" is null, but non null value was expected.');
        Assertion::choice($directMediaMethod, array (
          0 => 'update',
          1 => 'invite',
          2 => 'reinvite',
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
     * @deprecated
     * Set password
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        Assertion::notNull($password, 'password value "%s" is null, but non null value was expected.');
        Assertion::maxLength($password, 25, 'password value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @deprecated
     * Set mac
     *
     * @param string $mac
     *
     * @return self
     */
    public function setMac($mac = null)
    {
        if (!is_null($mac)) {
            Assertion::maxLength($mac, 12, 'mac value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->mac = $mac;

        return $this;
    }

    /**
     * Get mac
     *
     * @return string
     */
    public function getMac()
    {
        return $this->mac;
    }

    /**
     * @deprecated
     * Set lastProvisionDate
     *
     * @param \DateTime $lastProvisionDate
     *
     * @return self
     */
    public function setLastProvisionDate($lastProvisionDate = null)
    {
        if (!is_null($lastProvisionDate)) {
            $lastProvisionDate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
                $lastProvisionDate,
                null
            );
        }

        $this->lastProvisionDate = $lastProvisionDate;

        return $this;
    }

    /**
     * Get lastProvisionDate
     *
     * @return \DateTime
     */
    public function getLastProvisionDate()
    {
        return $this->lastProvisionDate;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
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
     * @return \Ivoz\Provider\Domain\Model\Domain\DomainInterface
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set terminalModel
     *
     * @param \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface $terminalModel
     *
     * @return self
     */
    public function setTerminalModel(\Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface $terminalModel = null)
    {
        $this->terminalModel = $terminalModel;

        return $this;
    }

    /**
     * Get terminalModel
     *
     * @return \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface
     */
    public function getTerminalModel()
    {
        return $this->terminalModel;
    }

    // @codeCoverageIgnoreEnd
}
