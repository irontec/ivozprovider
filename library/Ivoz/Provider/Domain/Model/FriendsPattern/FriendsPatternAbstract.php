<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\FriendsPattern;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Friend\Friend;

/**
* FriendsPatternAbstract
* @codeCoverageIgnore
*/
abstract class FriendsPatternAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $regExp;

    /**
     * @var FriendInterface
     * inversedBy patterns
     */
    protected $friend;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $regExp
    ) {
        $this->setName($name);
        $this->setRegExp($regExp);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "FriendsPattern",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): FriendsPatternDto
    {
        return new FriendsPatternDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|FriendsPatternInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?FriendsPatternDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, FriendsPatternInterface::class);

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
     * @param FriendsPatternDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, FriendsPatternDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $regExp = $dto->getRegExp();
        Assertion::notNull($regExp, 'getRegExp value is null, but non null value was expected.');
        $friend = $dto->getFriend();
        Assertion::notNull($friend, 'getFriend value is null, but non null value was expected.');

        $self = new static(
            $name,
            $regExp
        );

        $self
            ->setFriend($fkTransformer->transform($friend));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FriendsPatternDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, FriendsPatternDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $regExp = $dto->getRegExp();
        Assertion::notNull($regExp, 'getRegExp value is null, but non null value was expected.');
        $friend = $dto->getFriend();
        Assertion::notNull($friend, 'getFriend value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setRegExp($regExp)
            ->setFriend($fkTransformer->transform($friend));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): FriendsPatternDto
    {
        return self::createDto()
            ->setName(self::getName())
            ->setRegExp(self::getRegExp())
            ->setFriend(Friend::entityToDto(self::getFriend(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'name' => self::getName(),
            'regExp' => self::getRegExp(),
            'friendId' => self::getFriend()->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setRegExp(string $regExp): static
    {
        Assertion::maxLength($regExp, 255, 'regExp value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->regExp = $regExp;

        return $this;
    }

    public function getRegExp(): string
    {
        return $this->regExp;
    }

    public function setFriend(FriendInterface $friend): static
    {
        $this->friend = $friend;

        return $this;
    }

    public function getFriend(): FriendInterface
    {
        return $this->friend;
    }
}
