<?php

namespace Ivoz\Provider\Domain\Model\FriendsPattern;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * FriendsPatternAbstract
 * @codeCoverageIgnore
 */
abstract class FriendsPatternAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $regExp;

    /**
     * @var \Ivoz\Provider\Domain\Model\Friend\FriendInterface
     */
    protected $friend;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($name, $regExp)
    {
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
     * @param null $id
     * @return FriendsPatternDto
     */
    public static function createDto($id = null)
    {
        return new FriendsPatternDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto FriendsPatternDto
         */
        Assertion::isInstanceOf($dto, FriendsPatternDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getRegExp()
        );

        $self
            ->setFriend($dto->getFriend())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto FriendsPatternDto
         */
        Assertion::isInstanceOf($dto, FriendsPatternDto::class);

        $this
            ->setName($dto->getName())
            ->setRegExp($dto->getRegExp())
            ->setFriend($dto->getFriend());



        $this->sanitizeValues();
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
            ->setFriend(\Ivoz\Provider\Domain\Model\Friend\Friend::entityToDto(self::getFriend(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'regExp' => self::getRegExp(),
            'friendId' => self::getFriend() ? self::getFriend()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    protected function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set regExp
     *
     * @param string $regExp
     *
     * @return self
     */
    protected function setRegExp($regExp)
    {
        Assertion::notNull($regExp, 'regExp value "%s" is null, but non null value was expected.');
        Assertion::maxLength($regExp, 255, 'regExp value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->regExp = $regExp;

        return $this;
    }

    /**
     * Get regExp
     *
     * @return string
     */
    public function getRegExp()
    {
        return $this->regExp;
    }

    /**
     * Set friend
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend
     *
     * @return self
     */
    public function setFriend(\Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend = null)
    {
        $this->friend = $friend;

        return $this;
    }

    /**
     * Get friend
     *
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendInterface
     */
    public function getFriend()
    {
        return $this->friend;
    }

    // @codeCoverageIgnoreEnd
}
