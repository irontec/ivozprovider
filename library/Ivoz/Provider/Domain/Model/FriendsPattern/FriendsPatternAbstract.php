<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\FriendsPattern;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
        $name,
        $regExp
    ) {
        $this->setName($name);
        $this->setRegExp($regExp);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "FriendsPattern",
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
     * @return FriendsPatternDto
     */
    public static function createDto($id = null)
    {
        return new FriendsPatternDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param FriendsPatternInterface|null $entity
     * @param int $depth
     * @return FriendsPatternDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var FriendsPatternDto $dto */
        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FriendsPatternDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FriendsPatternDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getRegExp()
        );

        $self
            ->setFriend($fkTransformer->transform($dto->getFriend()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FriendsPatternDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FriendsPatternDto::class);

        $this
            ->setName($dto->getName())
            ->setRegExp($dto->getRegExp())
            ->setFriend($fkTransformer->transform($dto->getFriend()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return FriendsPatternDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setRegExp(self::getRegExp())
            ->setFriend(Friend::entityToDto(self::getFriend(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
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

        /** @var  $this */
        return $this;
    }

    public function getFriend(): FriendInterface
    {
        return $this->friend;
    }
}
