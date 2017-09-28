<?php

namespace Ivoz\Kam\Domain\Model\Dispatcher;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * DispatcherAbstract
 * @codeCoverageIgnore
 */
abstract class DispatcherAbstract
{
    /**
     * @var integer
     */
    protected $setid = '0';

    /**
     * @var string
     */
    protected $destination = '';

    /**
     * @var integer
     */
    protected $flags = '0';

    /**
     * @var integer
     */
    protected $priority = '0';

    /**
     * @var string
     */
    protected $attrs = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface
     */
    protected $applicationServer;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct(
        $setid,
        $destination,
        $flags,
        $priority,
        $attrs,
        $description
    ) {
        $this->setSetid($setid);
        $this->setDestination($destination);
        $this->setFlags($flags);
        $this->setPriority($priority);
        $this->setAttrs($attrs);
        $this->setDescription($description);

        $this->initChangelog();
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
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
    }

    /**
     * @return DispatcherDTO
     */
    public static function createDTO()
    {
        return new DispatcherDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto DispatcherDTO
         */
        Assertion::isInstanceOf($dto, DispatcherDTO::class);

        $self = new static(
            $dto->getSetid(),
            $dto->getDestination(),
            $dto->getFlags(),
            $dto->getPriority(),
            $dto->getAttrs(),
            $dto->getDescription());

        return $self
            ->setApplicationServer($dto->getApplicationServer())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto DispatcherDTO
         */
        Assertion::isInstanceOf($dto, DispatcherDTO::class);

        $this
            ->setSetid($dto->getSetid())
            ->setDestination($dto->getDestination())
            ->setFlags($dto->getFlags())
            ->setPriority($dto->getPriority())
            ->setAttrs($dto->getAttrs())
            ->setDescription($dto->getDescription())
            ->setApplicationServer($dto->getApplicationServer());


        return $this;
    }

    /**
     * @return DispatcherDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setSetid($this->getSetid())
            ->setDestination($this->getDestination())
            ->setFlags($this->getFlags())
            ->setPriority($this->getPriority())
            ->setAttrs($this->getAttrs())
            ->setDescription($this->getDescription())
            ->setApplicationServerId($this->getApplicationServer() ? $this->getApplicationServer()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'setid' => $this->getSetid(),
            'destination' => $this->getDestination(),
            'flags' => $this->getFlags(),
            'priority' => $this->getPriority(),
            'attrs' => $this->getAttrs(),
            'description' => $this->getDescription(),
            'applicationServerId' => $this->getApplicationServer() ? $this->getApplicationServer()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set setid
     *
     * @param integer $setid
     *
     * @return self
     */
    public function setSetid($setid)
    {
        Assertion::notNull($setid);
        Assertion::integerish($setid);

        $this->setid = $setid;

        return $this;
    }

    /**
     * Get setid
     *
     * @return integer
     */
    public function getSetid()
    {
        return $this->setid;
    }

    /**
     * Set destination
     *
     * @param string $destination
     *
     * @return self
     */
    public function setDestination($destination)
    {
        Assertion::notNull($destination);
        Assertion::maxLength($destination, 192);

        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set flags
     *
     * @param integer $flags
     *
     * @return self
     */
    public function setFlags($flags)
    {
        Assertion::notNull($flags);
        Assertion::integerish($flags);

        $this->flags = $flags;

        return $this;
    }

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    public function setPriority($priority)
    {
        Assertion::notNull($priority);
        Assertion::integerish($priority);

        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set attrs
     *
     * @param string $attrs
     *
     * @return self
     */
    public function setAttrs($attrs)
    {
        Assertion::notNull($attrs);
        Assertion::maxLength($attrs, 128);

        $this->attrs = $attrs;

        return $this;
    }

    /**
     * Get attrs
     *
     * @return string
     */
    public function getAttrs()
    {
        return $this->attrs;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        Assertion::notNull($description);
        Assertion::maxLength($description, 64);

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set applicationServer
     *
     * @param \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface $applicationServer
     *
     * @return self
     */
    public function setApplicationServer(\Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface $applicationServer)
    {
        $this->applicationServer = $applicationServer;

        return $this;
    }

    /**
     * Get applicationServer
     *
     * @return \Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface
     */
    public function getApplicationServer()
    {
        return $this->applicationServer;
    }



    // @codeCoverageIgnoreEnd
}

