<?php

namespace Ivoz\Provider\Domain\Model\XMLRPCLog;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * XMLRPCLogAbstract
 * @codeCoverageIgnore
 */
abstract class XMLRPCLogAbstract
{
    /**
     * @var string
     */
    protected $proxy;

    /**
     * @var string
     */
    protected $module;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $mapperName;

    /**
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @var \DateTime
     */
    protected $execDate;

    /**
     * @var \DateTime
     */
    protected $finishDate;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct(
        $proxy,
        $module,
        $method,
        $mapperName,
        $startDate
    ) {
        $this->setProxy($proxy);
        $this->setModule($module);
        $this->setMethod($method);
        $this->setMapperName($mapperName);
        $this->setStartDate($startDate);

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
    public function getChangeSet()
    {
        return array_diff(
            $this->_initialValues,
            $this->__toArray()
        );
    }

    /**
     * @return XMLRPCLogDTO
     */
    public static function createDTO()
    {
        return new XMLRPCLogDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto XMLRPCLogDTO
         */
        Assertion::isInstanceOf($dto, XMLRPCLogDTO::class);

        $self = new static(
            $dto->getProxy(),
            $dto->getModule(),
            $dto->getMethod(),
            $dto->getMapperName(),
            $dto->getStartDate());

        return $self
            ->setExecDate($dto->getExecDate())
            ->setFinishDate($dto->getFinishDate())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto XMLRPCLogDTO
         */
        Assertion::isInstanceOf($dto, XMLRPCLogDTO::class);

        $this
            ->setProxy($dto->getProxy())
            ->setModule($dto->getModule())
            ->setMethod($dto->getMethod())
            ->setMapperName($dto->getMapperName())
            ->setStartDate($dto->getStartDate())
            ->setExecDate($dto->getExecDate())
            ->setFinishDate($dto->getFinishDate());


        return $this;
    }

    /**
     * @return XMLRPCLogDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setProxy($this->getProxy())
            ->setModule($this->getModule())
            ->setMethod($this->getMethod())
            ->setMapperName($this->getMapperName())
            ->setStartDate($this->getStartDate())
            ->setExecDate($this->getExecDate())
            ->setFinishDate($this->getFinishDate());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'proxy' => self::getProxy(),
            'module' => self::getModule(),
            'method' => self::getMethod(),
            'mapperName' => self::getMapperName(),
            'startDate' => self::getStartDate(),
            'execDate' => self::getExecDate(),
            'finishDate' => self::getFinishDate()
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set proxy
     *
     * @param string $proxy
     *
     * @return self
     */
    public function setProxy($proxy)
    {
        Assertion::notNull($proxy);
        Assertion::maxLength($proxy, 10);

        $this->proxy = $proxy;

        return $this;
    }

    /**
     * Get proxy
     *
     * @return string
     */
    public function getProxy()
    {
        return $this->proxy;
    }

    /**
     * Set module
     *
     * @param string $module
     *
     * @return self
     */
    public function setModule($module)
    {
        Assertion::notNull($module);
        Assertion::maxLength($module, 10);

        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set method
     *
     * @param string $method
     *
     * @return self
     */
    public function setMethod($method)
    {
        Assertion::notNull($method);
        Assertion::maxLength($method, 10);

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
     * Set mapperName
     *
     * @param string $mapperName
     *
     * @return self
     */
    public function setMapperName($mapperName)
    {
        Assertion::notNull($mapperName);
        Assertion::maxLength($mapperName, 20);

        $this->mapperName = $mapperName;

        return $this;
    }

    /**
     * Get mapperName
     *
     * @return string
     */
    public function getMapperName()
    {
        return $this->mapperName;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return self
     */
    public function setStartDate($startDate)
    {
        Assertion::notNull($startDate);
        $startDate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $startDate,
            'CURRENT_TIMESTAMP'
        );

        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set execDate
     *
     * @param \DateTime $execDate
     *
     * @return self
     */
    public function setExecDate($execDate = null)
    {
        if (!is_null($execDate)) {
        $execDate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $execDate,
            null
        );
        }

        $this->execDate = $execDate;

        return $this;
    }

    /**
     * Get execDate
     *
     * @return \DateTime
     */
    public function getExecDate()
    {
        return $this->execDate;
    }

    /**
     * Set finishDate
     *
     * @param \DateTime $finishDate
     *
     * @return self
     */
    public function setFinishDate($finishDate = null)
    {
        if (!is_null($finishDate)) {
        $finishDate = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $finishDate,
            null
        );
        }

        $this->finishDate = $finishDate;

        return $this;
    }

    /**
     * Get finishDate
     *
     * @return \DateTime
     */
    public function getFinishDate()
    {
        return $this->finishDate;
    }



    // @codeCoverageIgnoreEnd
}

