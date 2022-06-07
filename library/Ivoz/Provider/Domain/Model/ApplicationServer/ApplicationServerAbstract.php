<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ApplicationServer;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* ApplicationServerAbstract
* @codeCoverageIgnore
*/
abstract class ApplicationServerAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $ip;

    /**
     * @var string
     */
    protected $name;

    /**
     * Constructor
     */
    protected function __construct(
        string $ip,
        string $name
    ) {
        $this->setIp($ip);
        $this->setName($name);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "ApplicationServer",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): ApplicationServerDto
    {
        return new ApplicationServerDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ApplicationServerInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ApplicationServerDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ApplicationServerInterface::class);

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
     * @param ApplicationServerDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ApplicationServerDto::class);
        $ip = $dto->getIp();
        Assertion::notNull($ip, 'getIp value is null, but non null value was expected.');
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');

        $self = new static(
            $ip,
            $name
        );

        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ApplicationServerDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ApplicationServerDto::class);

        $ip = $dto->getIp();
        Assertion::notNull($ip, 'getIp value is null, but non null value was expected.');
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');

        $this
            ->setIp($ip)
            ->setName($name);

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ApplicationServerDto
    {
        return self::createDto()
            ->setIp(self::getIp())
            ->setName(self::getName());
    }

    protected function __toArray(): array
    {
        return [
            'ip' => self::getIp(),
            'name' => self::getName()
        ];
    }

    protected function setIp(string $ip): static
    {
        Assertion::maxLength($ip, 50, 'ip value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ip = $ip;

        return $this;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 64, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
