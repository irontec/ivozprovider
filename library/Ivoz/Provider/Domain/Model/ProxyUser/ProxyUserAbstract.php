<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\ProxyUser;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* ProxyUserAbstract
* @codeCoverageIgnore
*/
abstract class ProxyUserAbstract
{
    use ChangelogTrait;

    /**
     * @var string | null
     */
    protected $name;

    /**
     * @var string | null
     */
    protected $ip;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "ProxyUser",
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
     * @param mixed $id
     * @return ProxyUserDto
     */
    public static function createDto($id = null)
    {
        return new ProxyUserDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ProxyUserInterface|null $entity
     * @param int $depth
     * @return ProxyUserDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ProxyUserInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var ProxyUserDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ProxyUserDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ProxyUserDto::class);

        $self = new static();

        $self
            ->setName($dto->getName())
            ->setIp($dto->getIp());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ProxyUserDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ProxyUserDto::class);

        $this
            ->setName($dto->getName())
            ->setIp($dto->getIp());

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ProxyUserDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setIp(self::getIp());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'ip' => self::getIp()
        ];
    }

    protected function setName(?string $name = null): static
    {
        if (!is_null($name)) {
            Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    protected function setIp(?string $ip = null): static
    {
        if (!is_null($ip)) {
            Assertion::maxLength($ip, 50, 'ip value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ip = $ip;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }
}
