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
     * @column calling_code
     * @var integer
     */
    protected $callingCode;

    /**
     * @var string
     */
    protected $intCode;

    /**
     * @var string
     */
    protected $e164Pattern;

    /**
     * @var boolean
     */
    protected $nationalCC = '0';

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
    public function __construct(
        $code,
        $nationalCC,
        Name $name,
        Zone $zone
    ) {
        $this->setCode($code);
        $this->setNationalCC($nationalCC);
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
            $dto->getNationalCC(),
            $name,
            $zone
        );

        return $self
            ->setCallingCode($dto->getCallingCode())
            ->setIntCode($dto->getIntCode())
            ->setE164Pattern($dto->getE164Pattern())
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
            ->setCallingCode($dto->getCallingCode())
            ->setIntCode($dto->getIntCode())
            ->setE164Pattern($dto->getE164Pattern())
            ->setNationalCC($dto->getNationalCC())
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
            ->setCallingCode($this->getCallingCode())
            ->setIntCode($this->getIntCode())
            ->setE164Pattern($this->getE164Pattern())
            ->setNationalCC($this->getNationalCC())
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
            'callingCode' => self::getCallingCode(),
            'intCode' => self::getIntCode(),
            'e164Pattern' => self::getE164Pattern(),
            'nationalCC' => self::getNationalCC(),
            'en' => $this->getName()->getEn(),
            'es' => $this->getName()->getEs(),
            'en' => $this->getZone()->getEn(),
            'es' => $this->getZone()->getEs()
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
     * Set callingCode
     *
     * @param integer $callingCode
     *
     * @return self
     */
    public function setCallingCode($callingCode = null)
    {
        if (!is_null($callingCode)) {
            if (!is_null($callingCode)) {
                Assertion::integerish($callingCode);
                Assertion::greaterOrEqualThan($callingCode, 0);
            }
        }

        $this->callingCode = $callingCode;

        return $this;
    }

    /**
     * Get callingCode
     *
     * @return integer
     */
    public function getCallingCode()
    {
        return $this->callingCode;
    }

    /**
     * Set intCode
     *
     * @param string $intCode
     *
     * @return self
     */
    public function setIntCode($intCode = null)
    {
        if (!is_null($intCode)) {
            Assertion::maxLength($intCode, 5);
        }

        $this->intCode = $intCode;

        return $this;
    }

    /**
     * Get intCode
     *
     * @return string
     */
    public function getIntCode()
    {
        return $this->intCode;
    }

    /**
     * Set e164Pattern
     *
     * @param string $e164Pattern
     *
     * @return self
     */
    public function setE164Pattern($e164Pattern = null)
    {
        if (!is_null($e164Pattern)) {
            Assertion::maxLength($e164Pattern, 250);
        }

        $this->e164Pattern = $e164Pattern;

        return $this;
    }

    /**
     * Get e164Pattern
     *
     * @return string
     */
    public function getE164Pattern()
    {
        return $this->e164Pattern;
    }

    /**
     * Set nationalCC
     *
     * @param boolean $nationalCC
     *
     * @return self
     */
    public function setNationalCC($nationalCC)
    {
        Assertion::notNull($nationalCC);
        Assertion::between(intval($nationalCC), 0, 1);

        $this->nationalCC = $nationalCC;

        return $this;
    }

    /**
     * Get nationalCC
     *
     * @return boolean
     */
    public function getNationalCC()
    {
        return $this->nationalCC;
    }

    /**
     * Set name
     *
     * @param Name $name
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
     * @return Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set zone
     *
     * @param Zone $zone
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
     * @return Zone
     */
    public function getZone()
    {
        return $this->zone;
    }

    // @codeCoverageIgnoreEnd
}

