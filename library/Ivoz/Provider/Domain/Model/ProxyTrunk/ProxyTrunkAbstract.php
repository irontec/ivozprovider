<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunk;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * ProxyTrunkAbstract
 * @codeCoverageIgnore
 */
abstract class ProxyTrunkAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $ip;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($ip)
    {
        $this->setIp($ip);

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
     * @return ProxyTrunkDTO
     */
    public static function createDTO()
    {
        return new ProxyTrunkDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ProxyTrunkDTO
         */
        Assertion::isInstanceOf($dto, ProxyTrunkDTO::class);

        $self = new static(
            $dto->getIp());

        return $self
            ->setName($dto->getName())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ProxyTrunkDTO
         */
        Assertion::isInstanceOf($dto, ProxyTrunkDTO::class);

        $this
            ->setName($dto->getName())
            ->setIp($dto->getIp());


        return $this;
    }

    /**
     * @return ProxyTrunkDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setName($this->getName())
            ->setIp($this->getIp());
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


    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name = null)
    {
        if (!is_null($name)) {
            Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

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
     * Set ip
     *
     * @param string $ip
     *
     * @return self
     */
    public function setIp($ip)
    {
        Assertion::notNull($ip, 'ip value "%s" is null, but non null value was expected.');
        Assertion::maxLength($ip, 50, 'ip value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }



    // @codeCoverageIgnoreEnd
}

