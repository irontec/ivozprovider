<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServer;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSet;

/**
* ApplicationServerSetRelApplicationServerAbstract
* @codeCoverageIgnore
*/
abstract class ApplicationServerSetRelApplicationServerAbstract
{
    use ChangelogTrait;

    /**
     * @var ApplicationServerInterface
     */
    protected $applicationServer;

    /**
     * @var ?ApplicationServerSetInterface
     * inversedBy relApplicationServers
     */
    protected $applicationServerSet = null;

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
            "ApplicationServerSetRelApplicationServer",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): ApplicationServerSetRelApplicationServerDto
    {
        return new ApplicationServerSetRelApplicationServerDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ApplicationServerSetRelApplicationServerInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ApplicationServerSetRelApplicationServerDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ApplicationServerSetRelApplicationServerInterface::class);

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
     * @param ApplicationServerSetRelApplicationServerDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ApplicationServerSetRelApplicationServerDto::class);
        $applicationServer = $dto->getApplicationServer();
        Assertion::notNull($applicationServer, 'getApplicationServer value is null, but non null value was expected.');

        $self = new static();

        $self
            ->setApplicationServer($fkTransformer->transform($applicationServer))
            ->setApplicationServerSet($fkTransformer->transform($dto->getApplicationServerSet()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ApplicationServerSetRelApplicationServerDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ApplicationServerSetRelApplicationServerDto::class);

        $applicationServer = $dto->getApplicationServer();
        Assertion::notNull($applicationServer, 'getApplicationServer value is null, but non null value was expected.');

        $this
            ->setApplicationServer($fkTransformer->transform($applicationServer))
            ->setApplicationServerSet($fkTransformer->transform($dto->getApplicationServerSet()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ApplicationServerSetRelApplicationServerDto
    {
        return self::createDto()
            ->setApplicationServer(ApplicationServer::entityToDto(self::getApplicationServer(), $depth))
            ->setApplicationServerSet(ApplicationServerSet::entityToDto(self::getApplicationServerSet(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'applicationServerId' => self::getApplicationServer()->getId(),
            'applicationServerSetId' => self::getApplicationServerSet()?->getId()
        ];
    }

    protected function setApplicationServer(ApplicationServerInterface $applicationServer): static
    {
        $this->applicationServer = $applicationServer;

        return $this;
    }

    public function getApplicationServer(): ApplicationServerInterface
    {
        return $this->applicationServer;
    }

    public function setApplicationServerSet(?ApplicationServerSetInterface $applicationServerSet = null): static
    {
        $this->applicationServerSet = $applicationServerSet;

        return $this;
    }

    public function getApplicationServerSet(): ?ApplicationServerSetInterface
    {
        return $this->applicationServerSet;
    }
}
