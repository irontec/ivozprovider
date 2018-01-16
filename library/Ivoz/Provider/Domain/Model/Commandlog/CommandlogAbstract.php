<?php

namespace Ivoz\Provider\Domain\Model\Commandlog;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

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
     * @var string
     */
    protected $method;

    /**
     * @var array
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


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

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
        return sprintf("%s#%s",
            "Commandlog",
            $this->getId()
        );
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$dbFieldName] != $this->_initialValues[$dbFieldName];
    }

    public function getInitialValue($dbFieldName)
    {
        if (!array_key_exists($dbFieldName, $this->_initialValues)) {
            throw new \Exception($dbFieldName . ' field was not found');
        }

        return $this->_initialValues[$dbFieldName];
    }

    /**
     * @return array
     */
    protected function getChangeSet()
    {
        $changes = [];
        $currentValues = $this->__toArray();
        foreach ($currentValues as $key => $value) {

            if ($this->_initialValues[$key] == $currentValues[$key]) {
                continue;
            }

            $value = $currentValues[$key];
            if ($value instanceof \DateTime) {
                $value = $value->format('Y-m-d H:i:s');
            }

            $changes[$key] = $value;
        }

        return $changes;
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @return CommandlogDTO
     */
    public static function createDTO()
    {
        return new CommandlogDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CommandlogDTO
         */
        Assertion::isInstanceOf($dto, CommandlogDTO::class);

        $self = new static(
            $dto->getRequestId(),
            $dto->getClass(),
            $dto->getCreatedOn(),
            $dto->getMicrotime());

        $self
            ->setMethod($dto->getMethod())
            ->setArguments($dto->getArguments())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CommandlogDTO
         */
        Assertion::isInstanceOf($dto, CommandlogDTO::class);

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
     * @return CommandlogDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setRequestId($this->getRequestId())
            ->setClass($this->getClass())
            ->setMethod($this->getMethod())
            ->setArguments($this->getArguments())
            ->setCreatedOn($this->getCreatedOn())
            ->setMicrotime($this->getMicrotime());
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
    public function setRequestId($requestId)
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
    public function setClass($class)
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
    public function setMethod($method = null)
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
     * @return string
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
    public function setArguments($arguments = null)
    {
        if (!is_null($arguments)) {
        }

        $this->arguments = $arguments;

        return $this;
    }

    /**
     * Get arguments
     *
     * @return array
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
    public function setCreatedOn($createdOn)
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
    public function setMicrotime($microtime)
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

