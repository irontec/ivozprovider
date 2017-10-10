<?php

namespace Ivoz\Provider\Domain\Model\Timezone;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * TimezoneAbstract
 * @codeCoverageIgnore
 */
abstract class TimezoneAbstract
{
    /**
     * @var string
     */
    protected $tz;

    /**
     * @var string
     */
    protected $comment = '';

    /**
     * @var Label
     */
    protected $label;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $country;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($tz, Label $label)
    {
        $this->setTz($tz);
        $this->setLabel($label);

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
     * @return TimezoneDTO
     */
    public static function createDTO()
    {
        return new TimezoneDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TimezoneDTO
         */
        Assertion::isInstanceOf($dto, TimezoneDTO::class);

        $label = new Label(
            $dto->getLabelEn(),
            $dto->getLabelEs()
        );

        $self = new static(
            $dto->getTz(),
            $label
        );

        return $self
            ->setComment($dto->getComment())
            ->setCountry($dto->getCountry())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TimezoneDTO
         */
        Assertion::isInstanceOf($dto, TimezoneDTO::class);

        $label = new Label(
            $dto->getLabelEn(),
            $dto->getLabelEs()
        );

        $this
            ->setTz($dto->getTz())
            ->setComment($dto->getComment())
            ->setLabel($label)
            ->setCountry($dto->getCountry());


        return $this;
    }

    /**
     * @return TimezoneDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setTz($this->getTz())
            ->setComment($this->getComment())
            ->setLabelEn($this->getLabel()->getEn())
            ->setLabelEs($this->getLabel()->getEs())
            ->setCountryId($this->getCountry() ? $this->getCountry()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'tz' => self::getTz(),
            'comment' => self::getComment(),
            'en' => $this->getLabel()->getEn(),
            'es' => $this->getLabel()->getEs(),
            'countryId' => self::getCountry() ? self::getCountry()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set tz
     *
     * @param string $tz
     *
     * @return self
     */
    public function setTz($tz)
    {
        Assertion::notNull($tz);
        Assertion::maxLength($tz, 255);

        $this->tz = $tz;

        return $this;
    }

    /**
     * Get tz
     *
     * @return string
     */
    public function getTz()
    {
        return $this->tz;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return self
     */
    public function setComment($comment = null)
    {
        if (!is_null($comment)) {
            Assertion::maxLength($comment, 150);
        }

        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set country
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $country
     *
     * @return self
     */
    public function setCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set label
     *
     * @param Label $label
     *
     * @return self
     */
    public function setLabel(Label $label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return Label
     */
    public function getLabel()
    {
        return $this->label;
    }

    // @codeCoverageIgnoreEnd
}

