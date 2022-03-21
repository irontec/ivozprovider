<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Voicemail;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Locution\Locution;

/**
* VoicemailAbstract
* @codeCoverageIgnore
*/
abstract class VoicemailAbstract
{
    use ChangelogTrait;

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var ?string
     */
    protected $email = null;

    /**
     * @var bool
     */
    protected $sendMail = false;

    /**
     * @var bool
     */
    protected $attachSound = true;

    /**
     * @var ?UserInterface
     * inversedBy voicemail
     */
    protected $user = null;

    /**
     * @var ?ResidentialDeviceInterface
     * inversedBy voicemail
     */
    protected $residentialDevice = null;

    /**
     * @var CompanyInterface
     * inversedBy voicemails
     */
    protected $company;

    /**
     * @var ?LocutionInterface
     */
    protected $locution = null;

    /**
     * Constructor
     */
    protected function __construct(
        bool $enabled,
        string $name,
        bool $sendMail,
        bool $attachSound
    ) {
        $this->setEnabled($enabled);
        $this->setName($name);
        $this->setSendMail($sendMail);
        $this->setAttachSound($attachSound);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Voicemail",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): VoicemailDto
    {
        return new VoicemailDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|VoicemailInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?VoicemailDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, VoicemailInterface::class);

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
     * @param VoicemailDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, VoicemailDto::class);
        $enabled = $dto->getEnabled();
        Assertion::notNull($enabled, 'getEnabled value is null, but non null value was expected.');
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $sendMail = $dto->getSendMail();
        Assertion::notNull($sendMail, 'getSendMail value is null, but non null value was expected.');
        $attachSound = $dto->getAttachSound();
        Assertion::notNull($attachSound, 'getAttachSound value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $enabled,
            $name,
            $sendMail,
            $attachSound
        );

        $self
            ->setEmail($dto->getEmail())
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setCompany($fkTransformer->transform($company))
            ->setLocution($fkTransformer->transform($dto->getLocution()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param VoicemailDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, VoicemailDto::class);

        $enabled = $dto->getEnabled();
        Assertion::notNull($enabled, 'getEnabled value is null, but non null value was expected.');
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $sendMail = $dto->getSendMail();
        Assertion::notNull($sendMail, 'getSendMail value is null, but non null value was expected.');
        $attachSound = $dto->getAttachSound();
        Assertion::notNull($attachSound, 'getAttachSound value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setEnabled($enabled)
            ->setName($name)
            ->setEmail($dto->getEmail())
            ->setSendMail($sendMail)
            ->setAttachSound($attachSound)
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setCompany($fkTransformer->transform($company))
            ->setLocution($fkTransformer->transform($dto->getLocution()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): VoicemailDto
    {
        return self::createDto()
            ->setEnabled(self::getEnabled())
            ->setName(self::getName())
            ->setEmail(self::getEmail())
            ->setSendMail(self::getSendMail())
            ->setAttachSound(self::getAttachSound())
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setResidentialDevice(ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setLocution(Locution::entityToDto(self::getLocution(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'enabled' => self::getEnabled(),
            'name' => self::getName(),
            'email' => self::getEmail(),
            'sendMail' => self::getSendMail(),
            'attachSound' => self::getAttachSound(),
            'userId' => self::getUser()?->getId(),
            'residentialDeviceId' => self::getResidentialDevice()?->getId(),
            'companyId' => self::getCompany()->getId(),
            'locutionId' => self::getLocution()?->getId()
        ];
    }

    protected function setEnabled(bool $enabled): static
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 200, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setEmail(?string $email = null): static
    {
        if (!is_null($email)) {
            Assertion::maxLength($email, 200, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->email = $email;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    protected function setSendMail(bool $sendMail): static
    {
        $this->sendMail = $sendMail;

        return $this;
    }

    public function getSendMail(): bool
    {
        return $this->sendMail;
    }

    protected function setAttachSound(bool $attachSound): static
    {
        $this->attachSound = $attachSound;

        return $this;
    }

    public function getAttachSound(): bool
    {
        return $this->attachSound;
    }

    public function setUser(?UserInterface $user = null): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): static
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    public function getResidentialDevice(): ?ResidentialDeviceInterface
    {
        return $this->residentialDevice;
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

    protected function setLocution(?LocutionInterface $locution = null): static
    {
        $this->locution = $locution;

        return $this;
    }

    public function getLocution(): ?LocutionInterface
    {
        return $this->locution;
    }
}
