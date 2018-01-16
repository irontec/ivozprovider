<?php

namespace Ivoz\Provider\Domain\Model\MatchListPattern;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * MatchListPatternAbstract
 * @codeCoverageIgnore
 */
abstract class MatchListPatternAbstract
{
    /**
     * @var string
     */
    protected $description;

    /**
     * @comment enum:number|regexp
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $regexp;

    /**
     * @var string
     */
    protected $numbervalue;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    protected $matchList;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $numberCountry;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    protected function __construct($type)
    {
        $this->setType($type);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "MatchListPattern",
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
     * @return MatchListPatternDTO
     */
    public static function createDTO()
    {
        return new MatchListPatternDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto MatchListPatternDTO
         */
        Assertion::isInstanceOf($dto, MatchListPatternDTO::class);

        $self = new static(
            $dto->getType());

        $self
            ->setDescription($dto->getDescription())
            ->setRegexp($dto->getRegexp())
            ->setNumbervalue($dto->getNumbervalue())
            ->setMatchList($dto->getMatchList())
            ->setNumberCountry($dto->getNumberCountry())
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
         * @var $dto MatchListPatternDTO
         */
        Assertion::isInstanceOf($dto, MatchListPatternDTO::class);

        $this
            ->setDescription($dto->getDescription())
            ->setType($dto->getType())
            ->setRegexp($dto->getRegexp())
            ->setNumbervalue($dto->getNumbervalue())
            ->setMatchList($dto->getMatchList())
            ->setNumberCountry($dto->getNumberCountry());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @return MatchListPatternDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setDescription($this->getDescription())
            ->setType($this->getType())
            ->setRegexp($this->getRegexp())
            ->setNumbervalue($this->getNumbervalue())
            ->setMatchListId($this->getMatchList() ? $this->getMatchList()->getId() : null)
            ->setNumberCountryId($this->getNumberCountry() ? $this->getNumberCountry()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'description' => self::getDescription(),
            'type' => self::getType(),
            'regExp' => self::getRegexp(),
            'numberValue' => self::getNumbervalue(),
            'matchListId' => self::getMatchList() ? self::getMatchList()->getId() : null,
            'numberCountryId' => self::getNumberCountry() ? self::getNumberCountry()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description = null)
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 55, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

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
     * Set type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type)
    {
        Assertion::notNull($type, 'type value "%s" is null, but non null value was expected.');
        Assertion::maxLength($type, 10, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($type, array (
          0 => 'number',
          1 => 'regexp',
        ), 'typevalue "%s" is not an element of the valid values: %s');

        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set regexp
     *
     * @param string $regexp
     *
     * @return self
     */
    public function setRegexp($regexp = null)
    {
        if (!is_null($regexp)) {
            Assertion::maxLength($regexp, 255, 'regexp value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->regexp = $regexp;

        return $this;
    }

    /**
     * Get regexp
     *
     * @return string
     */
    public function getRegexp()
    {
        return $this->regexp;
    }

    /**
     * Set numbervalue
     *
     * @param string $numbervalue
     *
     * @return self
     */
    public function setNumbervalue($numbervalue = null)
    {
        if (!is_null($numbervalue)) {
            Assertion::maxLength($numbervalue, 25, 'numbervalue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->numbervalue = $numbervalue;

        return $this;
    }

    /**
     * Get numbervalue
     *
     * @return string
     */
    public function getNumbervalue()
    {
        return $this->numbervalue;
    }

    /**
     * Set matchList
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList
     *
     * @return self
     */
    public function setMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList = null)
    {
        $this->matchList = $matchList;

        return $this;
    }

    /**
     * Get matchList
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    public function getMatchList()
    {
        return $this->matchList;
    }

    /**
     * Set numberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $numberCountry
     *
     * @return self
     */
    public function setNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $numberCountry = null)
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    /**
     * Get numberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getNumberCountry()
    {
        return $this->numberCountry;
    }



    // @codeCoverageIgnoreEnd
}

