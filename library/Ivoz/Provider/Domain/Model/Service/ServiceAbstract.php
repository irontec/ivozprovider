<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Service;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Service\Name;
use Ivoz\Provider\Domain\Model\Service\Description;

/**
* ServiceAbstract
* @codeCoverageIgnore
*/
abstract class ServiceAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $iden = '';

    /**
     * @var string
     */
    protected $defaultCode;

    /**
     * @var bool
     */
    protected $extraArgs = false;

    /**
     * @var Name
     */
    protected $name;

    /**
     * @var Description
     */
    protected $description;

    /**
     * Constructor
     */
    protected function __construct(
        string $iden,
        string $defaultCode,
        bool $extraArgs,
        Name $name,
        Description $description
    ) {
        $this->setIden($iden);
        $this->setDefaultCode($defaultCode);
        $this->setExtraArgs($extraArgs);
        $this->name = $name;
        $this->description = $description;
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Service",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): ServiceDto
    {
        return new ServiceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ServiceInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ServiceDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ServiceInterface::class);

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
     * @param ServiceDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ServiceDto::class);
        Assertion::notNull($dto->getNameEn(), 'nameEn value is null, but non null value was expected.');
        Assertion::notNull($dto->getNameEs(), 'nameEs value is null, but non null value was expected.');
        Assertion::notNull($dto->getNameCa(), 'nameCa value is null, but non null value was expected.');
        Assertion::notNull($dto->getNameIt(), 'nameIt value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionEn(), 'descriptionEn value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionEs(), 'descriptionEs value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionCa(), 'descriptionCa value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionIt(), 'descriptionIt value is null, but non null value was expected.');
        $iden = $dto->getIden();
        Assertion::notNull($iden, 'getIden value is null, but non null value was expected.');
        $defaultCode = $dto->getDefaultCode();
        Assertion::notNull($defaultCode, 'getDefaultCode value is null, but non null value was expected.');
        $extraArgs = $dto->getExtraArgs();
        Assertion::notNull($extraArgs, 'getExtraArgs value is null, but non null value was expected.');

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $description = new Description(
            $dto->getDescriptionEn(),
            $dto->getDescriptionEs(),
            $dto->getDescriptionCa(),
            $dto->getDescriptionIt()
        );

        $self = new static(
            $iden,
            $defaultCode,
            $extraArgs,
            $name,
            $description
        );

        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ServiceDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ServiceDto::class);

        Assertion::notNull($dto->getNameEn(), 'nameEn value is null, but non null value was expected.');
        Assertion::notNull($dto->getNameEs(), 'nameEs value is null, but non null value was expected.');
        Assertion::notNull($dto->getNameCa(), 'nameCa value is null, but non null value was expected.');
        Assertion::notNull($dto->getNameIt(), 'nameIt value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionEn(), 'descriptionEn value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionEs(), 'descriptionEs value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionCa(), 'descriptionCa value is null, but non null value was expected.');
        Assertion::notNull($dto->getDescriptionIt(), 'descriptionIt value is null, but non null value was expected.');
        $iden = $dto->getIden();
        Assertion::notNull($iden, 'getIden value is null, but non null value was expected.');
        $defaultCode = $dto->getDefaultCode();
        Assertion::notNull($defaultCode, 'getDefaultCode value is null, but non null value was expected.');
        $extraArgs = $dto->getExtraArgs();
        Assertion::notNull($extraArgs, 'getExtraArgs value is null, but non null value was expected.');

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $description = new Description(
            $dto->getDescriptionEn(),
            $dto->getDescriptionEs(),
            $dto->getDescriptionCa(),
            $dto->getDescriptionIt()
        );

        $this
            ->setIden($iden)
            ->setDefaultCode($defaultCode)
            ->setExtraArgs($extraArgs)
            ->setName($name)
            ->setDescription($description);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ServiceDto
    {
        return self::createDto()
            ->setIden(self::getIden())
            ->setDefaultCode(self::getDefaultCode())
            ->setExtraArgs(self::getExtraArgs())
            ->setNameEn(self::getName()->getEn())
            ->setNameEs(self::getName()->getEs())
            ->setNameCa(self::getName()->getCa())
            ->setNameIt(self::getName()->getIt())
            ->setDescriptionEn(self::getDescription()->getEn())
            ->setDescriptionEs(self::getDescription()->getEs())
            ->setDescriptionCa(self::getDescription()->getCa())
            ->setDescriptionIt(self::getDescription()->getIt());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'iden' => self::getIden(),
            'defaultCode' => self::getDefaultCode(),
            'extraArgs' => self::getExtraArgs(),
            'nameEn' => self::getName()->getEn(),
            'nameEs' => self::getName()->getEs(),
            'nameCa' => self::getName()->getCa(),
            'nameIt' => self::getName()->getIt(),
            'descriptionEn' => self::getDescription()->getEn(),
            'descriptionEs' => self::getDescription()->getEs(),
            'descriptionCa' => self::getDescription()->getCa(),
            'descriptionIt' => self::getDescription()->getIt()
        ];
    }

    protected function setIden(string $iden): static
    {
        Assertion::maxLength($iden, 50, 'iden value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->iden = $iden;

        return $this;
    }

    public function getIden(): string
    {
        return $this->iden;
    }

    protected function setDefaultCode(string $defaultCode): static
    {
        Assertion::maxLength($defaultCode, 3, 'defaultCode value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->defaultCode = $defaultCode;

        return $this;
    }

    public function getDefaultCode(): string
    {
        return $this->defaultCode;
    }

    protected function setExtraArgs(bool $extraArgs): static
    {
        $this->extraArgs = $extraArgs;

        return $this;
    }

    public function getExtraArgs(): bool
    {
        return $this->extraArgs;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    protected function setName(Name $name): static
    {
        $isEqual = $this->name->equals($name);
        if ($isEqual) {
            return $this;
        }

        $this->name = $name;
        return $this;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }

    protected function setDescription(Description $description): static
    {
        $isEqual = $this->description->equals($description);
        if ($isEqual) {
            return $this;
        }

        $this->description = $description;
        return $this;
    }
}
