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
     * @var string | null
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
     * @var string | null
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
     * @var string | null
     */
    protected $mac;

    /**
     * @var \DateTime | null
     */
    protected $lastProvisionDate;

    /**
     * comment: enum:yes|no
     * @var string
     */
    protected $t38Passthrough = 'no';

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Domain\DomainInterface | null
     */
    protected $domain;

    /**
     * @var \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface | null
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
        $password,
        $t38Passthrough
    ) {
        $this->setDisallow($disallow);
        $this->setAllowAudio($allowAudio);
        $this->setDirectMediaMethod($directMediaMethod);
        $this->setPassword($password);
        $this->setT38Passthrough($t38Passthrough);
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
     * @param TerminalInterface|null $entity
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

        /** @var TerminalDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TerminalDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TerminalDto::class);

        $self = new static(
            $dto->getDisallow(),
            $dto->getAllowAudio(),
            $dto->getDirectMediaMethod(),
            $dto->getPassword(),
            $dto->getT38Passthrough()
        );

        $self
            ->setName($dto->getName())
            ->setAllowVideo($dto->getAllowVideo())
            ->setMac($dto->getMac())
            ->setLastProvisionDate($dto->getLastProvisionDate())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setTerminalModel($fkTransformer->transform($dto->getTerminalModel()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TerminalDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setT38Passthrough($dto->getT38Passthrough())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setTerminalModel($fkTransformer->transform($dto->getTerminalModel()));



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
            ->setT38Passthrough(self::getT38Passthrough())
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
            't38Passthrough' => self::getT38Passthrough(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'domainId' => self::getDomain() ? self::getDomain()->getId() : null,
            'terminalModelId' => self::getTerminalModel() ? self::getTerminalModel()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name | null
     *
     * @return static
     */
    protected function setName($name = null)
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
     * @return string | null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set disallow
     *
     * @param string $disallow
     *
     * @return static
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
     * Set allowAudio
     *
     * @param string $allowAudio
     *
     * @return static
     */
    protected function setAllowAudio($allowAudio)
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
     * Set allowVideo
     *
     * @param string $allowVideo | null
     *
     * @return static
     */
    protected function setAllowVideo($allowVideo = null)
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
     * @return string | null
     */
    public function getAllowVideo()
    {
        return $this->allowVideo;
    }

    /**
     * Set directMediaMethod
     *
     * @param string $directMediaMethod
     *
     * @return static
     */
    protected function setDirectMediaMethod($directMediaMethod)
    {
        Assertion::notNull($directMediaMethod, 'directMediaMethod value "%s" is null, but non null value was expected.');
        Assertion::choice($directMediaMethod, [
            TerminalInterface::DIRECTMEDIAMETHOD_UPDATE,
            TerminalInterface::DIRECTMEDIAMETHOD_INVITE,
            TerminalInterface::DIRECTMEDIAMETHOD_REINVITE
        ], 'directMediaMethodvalue "%s" is not an element of the valid values: %s');

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
     * Set password
     *
     * @param string $password
     *
     * @return static
     */
    protected function setPassword($password)
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
     * Set mac
     *
     * @param string $mac | null
     *
     * @return static
     */
    protected function setMac($mac = null)
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
     * @return string | null
     */
    public function getMac()
    {
        return $this->mac;
    }

    /**
     * Set lastProvisionDate
     *
     * @param \DateTime $lastProvisionDate | null
     *
     * @return static
     */
    protected function setLastProvisionDate($lastProvisionDate = null)
    {
        if (!is_null($lastProvisionDate)) {
            $lastProvisionDate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
                $lastProvisionDate,
                null
            );

            if ($this->lastProvisionDate == $lastProvisionDate) {
                return $this;
            }
        }

        $this->lastProvisionDate = $lastProvisionDate;

        return $this;
    }

    /**
     * Get lastProvisionDate
     *
     * @return \DateTime | null
     */
    public function getLastProvisionDate()
    {
        return !is_null($this->lastProvisionDate) ? clone $this->lastProvisionDate : null;
    }

    /**
     * Set t38Passthrough
     *
     * @param string $t38Passthrough
     *
     * @return static
     */
    protected function setT38Passthrough($t38Passthrough)
    {
        Assertion::notNull($t38Passthrough, 't38Passthrough value "%s" is null, but non null value was expected.');
        Assertion::choice($t38Passthrough, [
            TerminalInterface::T38PASSTHROUGH_YES,
            TerminalInterface::T38PASSTHROUGH_NO
        ], 't38Passthroughvalue "%s" is not an element of the valid values: %s');

        $this->t38Passthrough = $t38Passthrough;

        return $this;
    }

    /**
     * Get t38Passthrough
     *
     * @return string
     */
    public function getT38Passthrough()
    {
        return $this->t38Passthrough;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
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
     * @param \Ivoz\Provider\Domain\Model\Domain\DomainInterface $domain | null
     *
     * @return static
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
     * Set terminalModel
     *
     * @param \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface $terminalModel | null
     *
     * @return static
     */
    public function setTerminalModel(\Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface $terminalModel = null)
    {
        $this->terminalModel = $terminalModel;

        return $this;
    }

    /**
     * Get terminalModel
     *
     * @return \Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface | null
     */
    public function getTerminalModel()
    {
        return $this->terminalModel;
    }

    // @codeCoverageIgnoreEnd
}
