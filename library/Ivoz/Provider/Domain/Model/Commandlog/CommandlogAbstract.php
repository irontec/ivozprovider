<?php

namespace Ivoz\Provider\Domain\Model\Commandlog;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CommandlogAbstract
 * @codeCoverageIgnore
 */
abstract class CommandlogAbstract
{
    /**
     * @var guid
     */
    protected $requestId;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var string | null
     */
    protected $method;

    /**
     * @var array | null
     */
    protected $arguments;

    /**
     * @var \DateTime
     */
    protected $createdOn;

    /**
     * @var integer
     */
    protected $microtime;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $requestId,
        $class,
        $createdOn,
        $microtime
    ) {
        $this->setRequestId($requestId);
        $this->setClass($class);
        $this->setCreatedOn($createdOn);
        $this->setMicrotime($microtime);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Commandlog",
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
     * @return CommandlogDto
     */
    public static function createDto($id = null)
    {
        return new CommandlogDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return CommandlogDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CommandlogInterface::class);

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
         * @var $dto CommandlogDto
         */
        Assertion::isInstanceOf($dto, CommandlogDto::class);

        $self = new static(
            $dto->getRequestId(),
            $dto->getClass(),
            $dto->getCreatedOn(),
            $dto->getMicrotime()
        );

        $self
            ->setMethod($dto->getMethod())
            ->setArguments($dto->getArguments())
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
         * @var $dto CommandlogDto
         */
        Assertion::isInstanceOf($dto, CommandlogDto::class);

        $this
            ->setRequestId($dto->getRequestId())
            ->setClass($dto->getClass())
            ->setMethod($dto->getMethod())
            ->setArguments($dto->getArguments())
            ->setCreatedOn($dto->getCreatedOn())
            ->setMicrotime($dto->getMicrotime());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CommandlogDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setRequestId(self::getRequestId())
            ->setClass(self::getClass())
            ->setMethod(self::getMethod())
            ->setArguments(self::getArguments())
            ->setCreatedOn(self::getCreatedOn())
            ->setMicrotime(self::getMicrotime());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'requestId' => self::getRequestId(),
            'class' => self::getClass(),
            'method' => self::getMethod(),
            'arguments' => self::getArguments(),
            'createdOn' => self::getCreatedOn(),
            'microtime' => self::getMicrotime()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set requestId
     *
     * @param guid $requestId
     *
     * @return self
     */
    protected function setRequestId($requestId)
    {
        Assertion::notNull($requestId, 'requestId value "%s" is null, but non null value was expected.');

        $this->requestId = $requestId;

        return $this;
    }

    /**
     * Get requestId
     *
     * @return guid
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * Set class
     *
     * @param string $class
     *
     * @return self
     */
    protected function setClass($class)
    {
        Assertion::notNull($class, 'class value "%s" is null, but non null value was expected.');
        Assertion::maxLength($class, 50, 'class value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set method
     *
     * @param string $method
     *
     * @return self
     */
    protected function setMethod($method = null)
    {
        if (!is_null($method)) {
            Assertion::maxLength($method, 64, 'method value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->method = $method;

        return $this;
    }

    /**
     * Get method
     *
     * @return string | null
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set arguments
     *
     * @param array $arguments
     *
     * @return self
     */
    protected function setArguments($arguments = null)
    {
        if (!is_null($arguments)) {
        }

        $this->arguments = $arguments;

        return $this;
    }

    /**
     * Get arguments
     *
     * @return array | null
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return self
     */
    protected function setCreatedOn($createdOn)
    {
        Assertion::notNull($createdOn, 'createdOn value "%s" is null, but non null value was expected.');
        $createdOn = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $createdOn,
            null
        );

        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set microtime
     *
     * @param integer $microtime
     *
     * @return self
     */
    protected function setMicrotime($microtime)
    {
        Assertion::notNull($microtime, 'microtime value "%s" is null, but non null value was expected.');
        Assertion::integerish($microtime, 'microtime value "%s" is not an integer or a number castable to integer.');

        $this->microtime = $microtime;

        return $this;
    }

    /**
     * Get microtime
     *
     * @return integer
     */
    public function getMicrotime()
    {
        return $this->microtime;
    }

    // @codeCoverageIgnoreEnd
}
