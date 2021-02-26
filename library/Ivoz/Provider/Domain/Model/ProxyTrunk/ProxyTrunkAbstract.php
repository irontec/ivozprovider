<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\ProxyTrunk;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* ProxyTrunkAbstract
* @codeCoverageIgnore
*/
abstract class ProxyTrunkAbstract
{
    use ChangelogTrait;

    /**
     * @var string | null
     */
    protected $name;

    /**
     * @var string
     */
    protected $ip;

    /**
     * Constructor
     */
    protected function __construct(
        $ip
    ) {
        $this->setIp($ip);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "ProxyTrunk",
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
     * @return ProxyTrunkDto
     */
    public static function createDto($id = null)
    {
        return new ProxyTrunkDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ProxyTrunkInterface|null $entity
     * @param int $depth
     * @return ProxyTrunkDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ProxyTrunkInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var ProxyTrunkDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ProxyTrunkDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ProxyTrunkDto::class);

        $self = new static(
            $dto->getIp()
        );

        $self
            ->setName($dto->getName());

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ProxyTrunkDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ProxyTrunkDto::class);

        $this
            ->setName($dto->getName())
            ->setIp($dto->getIp());

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ProxyTrunkDto
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

}
