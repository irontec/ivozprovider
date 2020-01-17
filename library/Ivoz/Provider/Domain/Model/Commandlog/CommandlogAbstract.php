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
     * @var string
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
     * @var array | null
     */
    protected $agent;

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
     * @param CommandlogInterface|null $entity
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

        /** @var CommandlogDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CommandlogDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
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
            ->setAgent($dto->getAgent())
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CommandlogDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CommandlogDto::class);

        $this
            ->setRequestId($dto->getRequestId())
            ->setClass($dto->getClass())
            ->setMethod($dto->getMethod())
            ->setArguments($dto->getArguments())
            ->setAgent($dto->getAgent())
            ->setCreatedOn($dto->getCreatedOn())
            ->setMicrotime($dto->getMicrotime());



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
            ->setAgent(self::getAgent())
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
            'agent' => self::getAgent(),
            'createdOn' => self::getCreatedOn(),
            'microtime' => self::getMicrotime()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set requestId
     *
     * @param string $requestId
     *
     * @return static
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
     * @return string
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
     * @return static
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
     * @param string $method | null
     *
     * @return static
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
     * @param array $arguments | null
     *
     * @return static
     */
    protected function setArguments($arguments = null)
    {
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
     * Set agent
     *
     * @param array $agent | null
     *
     * @return static
     */
    protected function setAgent($agent = null)
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Get agent
     *
     * @return array | null
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return static
     */
    protected function setCreatedOn($createdOn)
    {
        Assertion::notNull($createdOn, 'createdOn value "%s" is null, but non null value was expected.');
        $createdOn = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $createdOn,
            null
        );

        if ($this->createdOn == $createdOn) {
            return $this;
        }

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
        return clone $this->createdOn;
    }

    /**
     * Set microtime
     *
     * @param integer $microtime
     *
     * @return static
     */
    protected function setMicrotime($microtime)
    {
        Assertion::notNull($microtime, 'microtime value "%s" is null, but non null value was expected.');
        Assertion::integerish($microtime, 'microtime value "%s" is not an integer or a number castable to integer.');

        $this->microtime = (int) $microtime;

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
