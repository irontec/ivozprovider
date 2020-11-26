<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Terminal;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel;

/**
* TerminalAbstract
* @codeCoverageIgnore
*/
abstract class TerminalAbstract
{
    use ChangelogTrait;

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
     * @var \DateTimeInterface | null
     */
    protected $lastProvisionDate;

    /**
     * comment: enum:yes|no
     * @var string
     */
    protected $t38Passthrough = 'no';

    /**
     * @var bool
     */
    protected $rtpEncryption = false;

    /**
     * @var CompanyInterface
     * inversedBy terminals
     */
    protected $company;

    /**
     * @var DomainInterface
     * inversedBy terminals
     */
    protected $domain;

    /**
     * @var TerminalModelInterface
     */
    protected $terminalModel;

    /**
     * Constructor
     */
    protected function __construct(
        $disallow,
        $allowAudio,
        $directMediaMethod,
        $password,
        $t38Passthrough,
        $rtpEncryption
    ) {
        $this->setDisallow($disallow);
        $this->setAllowAudio($allowAudio);
        $this->setDirectMediaMethod($directMediaMethod);
        $this->setPassword($password);
        $this->setT38Passthrough($t38Passthrough);
        $this->setRtpEncryption($rtpEncryption);
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
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TerminalDto::class);

        $self = new static(
            $dto->getDisallow(),
            $dto->getAllowAudio(),
            $dto->getDirectMediaMethod(),
            $dto->getPassword(),
            $dto->getT38Passthrough(),
            $dto->getRtpEncryption()
        );

        $self
            ->setName($dto->getName())
            ->setAllowVideo($dto->getAllowVideo())
            ->setMac($dto->getMac())
            ->setLastProvisionDate($dto->getLastProvisionDate())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setTerminalModel($fkTransformer->transform($dto->getTerminalModel()));

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
        ForeignKeyTransformerInterface $fkTransformer
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
            ->setRtpEncryption($dto->getRtpEncryption())
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
            ->setRtpEncryption(self::getRtpEncryption())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setDomain(Domain::entityToDto(self::getDomain(), $depth))
            ->setTerminalModel(TerminalModel::entityToDto(self::getTerminalModel(), $depth));
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
            'rtpEncryption' => self::getRtpEncryption(),
            'companyId' => self::getCompany()->getId(),
            'domainId' => self::getDomain() ? self::getDomain()->getId() : null,
            'terminalModelId' => self::getTerminalModel() ? self::getTerminalModel()->getId() : null
        ];
    }

    /**
     * Set name
     *
     * @param string $name | null
     *
     * @return static
     */
    protected function setName(?string $name = null): TerminalInterface
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
    public function getName(): ?string
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
    protected function setDisallow(string $disallow): TerminalInterface
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
     * Set allowAudio
     *
     * @param string $allowAudio
     *
     * @return static
     */
    protected function setAllowAudio(string $allowAudio): TerminalInterface
    {
        Assertion::maxLength($allowAudio, 200, 'allowAudio value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->allowAudio = $allowAudio;

        return $this;
    }

    /**
     * Get allowAudio
     *
     * @return string
     */
    public function getAllowAudio(): string
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
    protected function setAllowVideo(?string $allowVideo = null): TerminalInterface
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
    public function getAllowVideo(): ?string
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
    protected function setDirectMediaMethod(string $directMediaMethod): TerminalInterface
    {
        Assertion::choice(
            $directMediaMethod,
            [
                TerminalInterface::DIRECTMEDIAMETHOD_UPDATE,
                TerminalInterface::DIRECTMEDIAMETHOD_INVITE,
                TerminalInterface::DIRECTMEDIAMETHOD_REINVITE,
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
     * Set password
     *
     * @param string $password
     *
     * @return static
     */
    protected function setPassword(string $password): TerminalInterface
    {
        Assertion::maxLength($password, 25, 'password value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): string
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
    protected function setMac(?string $mac = null): TerminalInterface
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
    public function getMac(): ?string
    {
        return $this->mac;
    }

    /**
     * Set lastProvisionDate
     *
     * @param \DateTimeInterface $lastProvisionDate | null
     *
     * @return static
     */
    protected function setLastProvisionDate($lastProvisionDate = null): TerminalInterface
    {
        if (!is_null($lastProvisionDate)) {
            Assertion::notNull(
                $lastProvisionDate,
                'lastProvisionDate value "%s" is null, but non null value was expected.'
            );
            $lastProvisionDate = DateTimeHelper::createOrFix(
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
     * @return \DateTimeInterface | null
     */
    public function getLastProvisionDate(): ?\DateTimeInterface
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
    protected function setT38Passthrough(string $t38Passthrough): TerminalInterface
    {
        Assertion::choice(
            $t38Passthrough,
            [
                TerminalInterface::T38PASSTHROUGH_YES,
                TerminalInterface::T38PASSTHROUGH_NO,
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
     * Set rtpEncryption
     *
     * @param bool $rtpEncryption
     *
     * @return static
     */
    protected function setRtpEncryption(bool $rtpEncryption): TerminalInterface
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
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    public function setCompany(CompanyInterface $company): TerminalInterface
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
    public function setDomain(?DomainInterface $domain = null): TerminalInterface
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
     * Set terminalModel
     *
     * @param TerminalModelInterface | null
     *
     * @return static
     */
    protected function setTerminalModel(?TerminalModelInterface $terminalModel = null): TerminalInterface
    {
        $this->terminalModel = $terminalModel;

        return $this;
    }

    /**
     * Get terminalModel
     *
     * @return TerminalModelInterface | null
     */
    public function getTerminalModel(): ?TerminalModelInterface
    {
        return $this->terminalModel;
    }

}
