<?php

namespace Ivoz\Provider\Domain\Model\MatchListPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\MatchList\MatchListDto;
use Ivoz\Provider\Domain\Model\Country\CountryDto;

/**
* MatchListPatternDtoAbstract
* @codeCoverageIgnore
*/
abstract class MatchListPatternDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string | null
     */
    private $description;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string | null
     */
    private $regexp;

    /**
     * @var string | null
     */
    private $numbervalue;

    /**
     * @var int
     */
    private $id;

    /**
     * @var MatchListDto | null
     */
    private $matchList;

    /**
     * @var CountryDto | null
     */
    private $numberCountry;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
        $response = [
            'description' => $this->getDescription(),
            'type' => $this->getType(),
            'regexp' => $this->getRegexp(),
            'numbervalue' => $this->getNumbervalue(),
            'id' => $this->getId(),
            'matchList' => $this->getMatchList(),
            'numberCountry' => $this->getNumberCountry()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param string $description | null
     *
     * @return static
     */
    public function setDescription(?string $description = null): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $type | null
     *
     * @return static
     */
    public function setType(?string $type = null): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $regexp | null
     *
     * @return static
     */
    public function setRegexp(?string $regexp = null): self
    {
        $this->regexp = $regexp;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRegexp(): ?string
    {
        return $this->regexp;
    }

    /**
     * @param string $numbervalue | null
     *
     * @return static
     */
    public function setNumbervalue(?string $numbervalue = null): self
    {
        $this->numbervalue = $numbervalue;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getNumbervalue(): ?string
    {
        return $this->numbervalue;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param MatchListDto | null
     *
     * @return static
     */
    public function setMatchList(?MatchListDto $matchList = null): self
    {
        $this->matchList = $matchList;

        return $this;
    }

    /**
     * @return MatchListDto | null
     */
    public function getMatchList(): ?MatchListDto
    {
        return $this->matchList;
    }

    /**
     * @return static
     */
    public function setMatchListId($id): self
    {
        $value = !is_null($id)
            ? new MatchListDto($id)
            : null;

        return $this->setMatchList($value);
    }

    /**
     * @return mixed | null
     */
    public function getMatchListId()
    {
        if ($dto = $this->getMatchList()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param CountryDto | null
     *
     * @return static
     */
    public function setNumberCountry(?CountryDto $numberCountry = null): self
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    /**
     * @return CountryDto | null
     */
    public function getNumberCountry(): ?CountryDto
    {
        return $this->numberCountry;
    }

    /**
     * @return static
     */
    public function setNumberCountryId($id): self
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setNumberCountry($value);
    }

    /**
     * @return mixed | null
     */
    public function getNumberCountryId()
    {
        if ($dto = $this->getNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

}
