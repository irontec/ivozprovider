<?php

namespace Ivoz\Provider\Domain\Model\Country;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * CountryAbstract
 * @codeCoverageIgnore
 */
abstract class CountryAbstract
{
    /**
     * @var string
     */
    protected $code = '';

    /**
     * @var integer
     */
    protected $countryCode;

    /**
     * @var Name
     */
    protected $name;

    /**
     * @var Zone
     */
    protected $zone;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($code, Name $name, Zone $zone)
    {
        $this->setCode($code);
        $this->setName($name);
        $this->setZone($zone);

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
     * @return CountryDTO
     */
    public static function createDTO()
    {
        return new CountryDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CountryDTO
         */
        Assertion::isInstanceOf($dto, CountryDTO::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs()
        );

        $zone = new Zone(
            $dto->getZoneEn(),
            $dto->getZoneEs()
        );

        $self = new static(
            $dto->getCode(),
            $name,
            $zone
        );

        return $self
            ->setCountryCode($dto->getCountryCode())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CountryDTO
         */
        Assertion::isInstanceOf($dto, CountryDTO::class);

        $name = new Name(
            $dto->getNameEn(),
            $dto->getNameEs()
        );

        $zone = new Zone(
            $dto->getZoneEn(),
            $dto->getZoneEs()
        );

        $this
            ->setCode($dto->getCode())
            ->setCountryCode($dto->getCountryCode())
            ->setName($name)
            ->setZone($zone);


        return $this;
    }

    /**
     * @return CountryDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setCode($this->getCode())
            ->setCountryCode($this->getCountryCode())
            ->setNameEn($this->getName()->getEn())
            ->setNameEs($this->getName()->getEs())
            ->setZoneEn($this->getZone()->getEn())
            ->setZoneEs($this->getZone()->getEs());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'code' => self::getCode(),
            'countryCode' => self::getCountryCode(),
            'nameEn' => self::getName()->getEn(),
            'nameEs' => self::getName()->getEs(),
            'zoneEn' => self::getZone()->getEn(),
            'zoneEs' => self::getZone()->getEs()
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set code
     *
     * @param string $code
     *
     * @return self
     */
    public function setCode($code)
    {
        Assertion::notNull($code);
        Assertion::maxLength($code, 100);

        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set countryCode
     *
     * @param integer $countryCode
     *
     * @return self
     */
    public function setCountryCode($countryCode = null)
    {
        if (!is_null($countryCode)) {
            if (!is_null($countryCode)) {
                Assertion::integerish($countryCode);
                Assertion::greaterOrEqualThan($countryCode, 0);
            }
        }

        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Get countryCode
     *
     * @return integer
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * Set name
     *
     * @param \Ivoz\Provider\Domain\Model\Country\Name $name
     *
     * @return self
     */
    public function setName(Name $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\Country\Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set zone
     *
     * @param \Ivoz\Provider\Domain\Model\Country\Zone $zone
     *
     * @return self
     */
    public function setZone(Zone $zone)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return \Ivoz\Provider\Domain\Model\Country\Zone
     */
    public function getZone()
    {
        return $this->zone;
    }

    // @codeCoverageIgnoreEnd
}

