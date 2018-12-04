<?php

namespace Ivoz\Provider\Domain\Model\MatchListPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class MatchListPatternDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $regexp;

    /**
     * @var string
     */
    private $numbervalue;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListDto | null
     */
    private $matchList;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryDto | null
     */
    private $numberCountry;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'description' => 'description',
            'type' => 'type',
            'regexp' => 'regexp',
            'numbervalue' => 'numbervalue',
            'id' => 'id',
            'matchListId' => 'matchList',
            'numberCountryId' => 'numberCountry'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'description' => $this->getDescription(),
            'type' => $this->getType(),
            'regexp' => $this->getRegexp(),
            'numbervalue' => $this->getNumbervalue(),
            'id' => $this->getId(),
            'matchList' => $this->getMatchList(),
            'numberCountry' => $this->getNumberCountry()
        ];
    }

    /**
     * @param string $description
     *
     * @return static
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $type
     *
     * @return static
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $regexp
     *
     * @return static
     */
    public function setRegexp($regexp = null)
    {
        $this->regexp = $regexp;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegexp()
    {
        return $this->regexp;
    }

    /**
     * @param string $numbervalue
     *
     * @return static
     */
    public function setNumbervalue($numbervalue = null)
    {
        $this->numbervalue = $numbervalue;

        return $this;
    }

    /**
     * @return string
     */
    public function getNumbervalue()
    {
        return $this->numbervalue;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListDto $matchList
     *
     * @return static
     */
    public function setMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchListDto $matchList = null)
    {
        $this->matchList = $matchList;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListDto
     */
    public function getMatchList()
    {
        return $this->matchList;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setMatchListId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\MatchList\MatchListDto($id)
            : null;

        return $this->setMatchList($value);
    }

    /**
     * @return integer | null
     */
    public function getMatchListId()
    {
        if ($dto = $this->getMatchList()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Country\CountryDto $numberCountry
     *
     * @return static
     */
    public function setNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryDto $numberCountry = null)
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Country\CountryDto
     */
    public function getNumberCountry()
    {
        return $this->numberCountry;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setNumberCountryId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Country\CountryDto($id)
            : null;

        return $this->setNumberCountry($value);
    }

    /**
     * @return integer | null
     */
    public function getNumberCountryId()
    {
        if ($dto = $this->getNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }
}
