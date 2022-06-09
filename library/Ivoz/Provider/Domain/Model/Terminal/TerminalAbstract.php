<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Terminal;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $disallow = 'all';

    /**
     * @var string
     * column: allow_audio
     */
    protected $allowAudio = 'alaw';

    /**
     * @var ?string
     * column: allow_video
     */
    protected $allowVideo = null;

    /**
     * @var string
     * column: direct_media_method
     * comment: enum:update|invite|reinvite
     */
    protected $directMediaMethod = 'update';

    /**
     * @var string
     * comment: password
     */
    protected $password = '';

    /**
     * @var ?string
     */
    protected $mac = null;

    /**
     * @var ?\DateTime
     */
    protected $lastProvisionDate = null;

    /**
     * @var string
     * comment: enum:yes|no
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
     * @var ?DomainInterface
     * inversedBy terminals
     */
    protected $domain = null;

    /**
     * @var ?TerminalModelInterface
     */
    protected $terminalModel = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $disallow,
        string $allowAudio,
        string $directMediaMethod,
        string $password,
        string $t38Passthrough,
        bool $rtpEncryption
    ) {
        $this->setName($name);
        $this->setDisallow($disallow);
        $this->setAllowAudio($allowAudio);
        $this->setDirectMediaMethod($directMediaMethod);
        $this->setPassword($password);
        $this->setT38Passthrough($t38Passthrough);
        $this->setRtpEncryption($rtpEncryption);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Terminal",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): TerminalDto
    {
        return new TerminalDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TerminalInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TerminalDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TerminalDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TerminalDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $disallow = $dto->getDisallow();
        Assertion::notNull($disallow, 'getDisallow value is null, but non null value was expected.');
        $allowAudio = $dto->getAllowAudio();
        Assertion::notNull($allowAudio, 'getAllowAudio value is null, but non null value was expected.');
        $directMediaMethod = $dto->getDirectMediaMethod();
        Assertion::notNull($directMediaMethod, 'getDirectMediaMethod value is null, but non null value was expected.');
        $password = $dto->getPassword();
        Assertion::notNull($password, 'getPassword value is null, but non null value was expected.');
        $t38Passthrough = $dto->getT38Passthrough();
        Assertion::notNull($t38Passthrough, 'getT38Passthrough value is null, but non null value was expected.');
        $rtpEncryption = $dto->getRtpEncryption();
        Assertion::notNull($rtpEncryption, 'getRtpEncryption value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $name,
            $disallow,
            $allowAudio,
            $directMediaMethod,
            $password,
            $t38Passthrough,
            $rtpEncryption
        );

        $self
            ->setAllowVideo($dto->getAllowVideo())
            ->setMac($dto->getMac())
            ->setLastProvisionDate($dto->getLastProvisionDate())
            ->setCompany($fkTransformer->transform($company))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setTerminalModel($fkTransformer->transform($dto->getTerminalModel()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TerminalDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TerminalDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $disallow = $dto->getDisallow();
        Assertion::notNull($disallow, 'getDisallow value is null, but non null value was expected.');
        $allowAudio = $dto->getAllowAudio();
        Assertion::notNull($allowAudio, 'getAllowAudio value is null, but non null value was expected.');
        $directMediaMethod = $dto->getDirectMediaMethod();
        Assertion::notNull($directMediaMethod, 'getDirectMediaMethod value is null, but non null value was expected.');
        $password = $dto->getPassword();
        Assertion::notNull($password, 'getPassword value is null, but non null value was expected.');
        $t38Passthrough = $dto->getT38Passthrough();
        Assertion::notNull($t38Passthrough, 'getT38Passthrough value is null, but non null value was expected.');
        $rtpEncryption = $dto->getRtpEncryption();
        Assertion::notNull($rtpEncryption, 'getRtpEncryption value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setDisallow($disallow)
            ->setAllowAudio($allowAudio)
            ->setAllowVideo($dto->getAllowVideo())
            ->setDirectMediaMethod($directMediaMethod)
            ->setPassword($password)
            ->setMac($dto->getMac())
            ->setLastProvisionDate($dto->getLastProvisionDate())
            ->setT38Passthrough($t38Passthrough)
            ->setRtpEncryption($rtpEncryption)
            ->setCompany($fkTransformer->transform($company))
            ->setDomain($fkTransformer->transform($dto->getDomain()))
            ->setTerminalModel($fkTransformer->transform($dto->getTerminalModel()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TerminalDto
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
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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
            'domainId' => self::getDomain()?->getId(),
            'terminalModelId' => self::getTerminalModel()?->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setDisallow(string $disallow): static
    {
        Assertion::maxLength($disallow, 200, 'disallow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->disallow = $disallow;

        return $this;
    }

    public function getDisallow(): string
    {
        return $this->disallow;
    }

    protected function setAllowAudio(string $allowAudio): static
    {
        Assertion::maxLength($allowAudio, 200, 'allowAudio value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->allowAudio = $allowAudio;

        return $this;
    }

    public function getAllowAudio(): string
    {
        return $this->allowAudio;
    }

    protected function setAllowVideo(?string $allowVideo = null): static
    {
        if (!is_null($allowVideo)) {
            Assertion::maxLength($allowVideo, 200, 'allowVideo value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->allowVideo = $allowVideo;

        return $this;
    }

    public function getAllowVideo(): ?string
    {
        return $this->allowVideo;
    }

    protected function setDirectMediaMethod(string $directMediaMethod): static
    {
        Assertion::maxLength($directMediaMethod, 25, 'directMediaMethod value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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

    public function getDirectMediaMethod(): string
    {
        return $this->directMediaMethod;
    }

    protected function setPassword(string $password): static
    {
        Assertion::maxLength($password, 25, 'password value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->password = $password;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    protected function setMac(?string $mac = null): static
    {
        if (!is_null($mac)) {
            Assertion::maxLength($mac, 12, 'mac value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->mac = $mac;

        return $this;
    }

    public function getMac(): ?string
    {
        return $this->mac;
    }

    protected function setLastProvisionDate(string|\DateTimeInterface|null $lastProvisionDate = null): static
    {
        if (!is_null($lastProvisionDate)) {

            /** @var ?\Datetime */
            $lastProvisionDate = DateTimeHelper::createOrFix(
                $lastProvisionDate,
                null
            );

            if ($this->isInitialized() && $this->lastProvisionDate == $lastProvisionDate) {
                return $this;
            }
        }

        $this->lastProvisionDate = $lastProvisionDate;

        return $this;
    }

    public function getLastProvisionDate(): ?\DateTime
    {
        return !is_null($this->lastProvisionDate) ? clone $this->lastProvisionDate : null;
    }

    protected function setT38Passthrough(string $t38Passthrough): static
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

    public function getT38Passthrough(): string
    {
        return $this->t38Passthrough;
    }

    protected function setRtpEncryption(bool $rtpEncryption): static
    {
        $this->rtpEncryption = $rtpEncryption;

        return $this;
    }

    public function getRtpEncryption(): bool
    {
        return $this->rtpEncryption;
    }

    public function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    public function setDomain(?DomainInterface $domain = null): static
    {
        $this->domain = $domain;

        return $this;
    }

    public function getDomain(): ?DomainInterface
    {
        return $this->domain;
    }

    protected function setTerminalModel(?TerminalModelInterface $terminalModel = null): static
    {
        $this->terminalModel = $terminalModel;

        return $this;
    }

    public function getTerminalModel(): ?TerminalModelInterface
    {
        return $this->terminalModel;
    }
}
