<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CompanyRelCodec;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Codec\CodecInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Codec\Codec;

/**
* CompanyRelCodecAbstract
* @codeCoverageIgnore
*/
abstract class CompanyRelCodecAbstract
{
    use ChangelogTrait;

    /**
     * @var ?CompanyInterface
     * inversedBy relCodecs
     */
    protected $company = null;

    /**
     * @var CodecInterface
     */
    protected $codec;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "CompanyRelCodec",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): CompanyRelCodecDto
    {
        return new CompanyRelCodecDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|CompanyRelCodecInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CompanyRelCodecDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CompanyRelCodecInterface::class);

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
     * @param CompanyRelCodecDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CompanyRelCodecDto::class);
        $codec = $dto->getCodec();
        Assertion::notNull($codec, 'getCodec value is null, but non null value was expected.');

        $self = new static();

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCodec($fkTransformer->transform($codec));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyRelCodecDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CompanyRelCodecDto::class);

        $codec = $dto->getCodec();
        Assertion::notNull($codec, 'getCodec value is null, but non null value was expected.');

        $this
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCodec($fkTransformer->transform($codec));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CompanyRelCodecDto
    {
        return self::createDto()
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCodec(Codec::entityToDto(self::getCodec(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'companyId' => self::getCompany()?->getId(),
            'codecId' => self::getCodec()->getId()
        ];
    }

    public function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    protected function setCodec(CodecInterface $codec): static
    {
        $this->codec = $codec;

        return $this;
    }

    public function getCodec(): CodecInterface
    {
        return $this->codec;
    }
}
