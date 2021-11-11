<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\PublicEntity;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\PublicEntity\Name;

/**
* PublicEntityAbstract
* @codeCoverageIgnore
*/
abstract class PublicEntityAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $iden;

    /**
     * @var ?string
     */
    protected $fqdn = null;

    /**
     * @var bool
     */
    protected $platform = false;

    /**
     * @var bool
     */
    protected $brand = false;

    /**
     * @var bool
     */
    protected $client = false;

    /**
     * @var Name
     */
    protected $name;

    /**
     * Constructor
     */
    protected function __construct(
        string $iden,
        bool $platform,
        bool $brand,
        bool $client,
        Name $name
    ) {
        $this->setIden($iden);
        $this->setPlatform($platform);
        $this->setBrand($brand);
        $this->setClient($client);
        $this->name = $name;
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "PublicEntity",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): PublicEntityDto
    {
        return new PublicEntityDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|PublicEntityInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?PublicEntityDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, PublicEntityInterface::class);

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
     * @param PublicEntityDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, PublicEntityDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $self = new static(
            $dto->getIden(),
            $dto->getPlatform(),
            $dto->getBrand(),
            $dto->getClient(),
            $name
        );

        $self
            ->setFqdn($dto->getFqdn());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param PublicEntityDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, PublicEntityDto::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs(),
            $dto->getNameCa(),
            $dto->getNameIt()
        );

        $this
            ->setIden($dto->getIden())
            ->setFqdn($dto->getFqdn())
            ->setPlatform($dto->getPlatform())
            ->setBrand($dto->getBrand())
            ->setClient($dto->getClient())
            ->setName($name);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): PublicEntityDto
    {
        return self::createDto()
            ->setIden(self::getIden())
            ->setFqdn(self::getFqdn())
            ->setPlatform(self::getPlatform())
            ->setBrand(self::getBrand())
            ->setClient(self::getClient())
            ->setNameEn(self::getName()->getEn())
            ->setNameEs(self::getName()->getEs())
            ->setNameCa(self::getName()->getCa())
            ->setNameIt(self::getName()->getIt());
    }

    protected function __toArray(): array
    {
        return [
            'iden' => self::getIden(),
            'fqdn' => self::getFqdn(),
            'platform' => self::getPlatform(),
            'brand' => self::getBrand(),
            'client' => self::getClient(),
            'nameEn' => self::getName()->getEn(),
            'nameEs' => self::getName()->getEs(),
            'nameCa' => self::getName()->getCa(),
            'nameIt' => self::getName()->getIt()
        ];
    }

    protected function setIden(string $iden): static
    {
        Assertion::maxLength($iden, 100, 'iden value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->iden = $iden;

        return $this;
    }

    public function getIden(): string
    {
        return $this->iden;
    }

    protected function setFqdn(?string $fqdn = null): static
    {
        if (!is_null($fqdn)) {
            Assertion::maxLength($fqdn, 200, 'fqdn value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->fqdn = $fqdn;

        return $this;
    }

    public function getFqdn(): ?string
    {
        return $this->fqdn;
    }

    protected function setPlatform(bool $platform): static
    {
        $this->platform = $platform;

        return $this;
    }

    public function getPlatform(): bool
    {
        return $this->platform;
    }

    protected function setBrand(bool $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): bool
    {
        return $this->brand;
    }

    protected function setClient(bool $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getClient(): bool
    {
        return $this->client;
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
}
