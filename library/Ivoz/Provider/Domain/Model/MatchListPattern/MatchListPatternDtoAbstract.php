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
     * @var string|null
     */
    private $description;

    /**
     * @var string
     */
    private $type = '';

    /**
     * @var string|null
     */
    private $regexp;

    /**
     * @var string|null
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

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setRegexp(?string $regexp): static
    {
        $this->regexp = $regexp;

        return $this;
    }

    public function getRegexp(): ?string
    {
        return $this->regexp;
    }

    public function setNumbervalue(?string $numbervalue): static
    {
        $this->numbervalue = $numbervalue;

        return $this;
    }

    public function getNumbervalue(): ?string
    {
        return $this->numbervalue;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setMatchList(?MatchListDto $matchList): static
    {
        $this->matchList = $matchList;

        return $this;
    }

    public function getMatchList(): ?MatchListDto
    {
        return $this->matchList;
    }

    public function setMatchListId($id): static
    {
        $value = !is_null($id)
            ? new MatchListDto($id)
            : null;

        return $this->setMatchList($value);
    }

    public function getMatchListId()
    {
        if ($dto = $this->getMatchList()) {
            return $dto->getId();
        }

        return null;
    }

    public function setNumberCountry(?CountryDto $numberCountry): static
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    public function getNumberCountry(): ?CountryDto
    {
        return $this->numberCountry;
    }

    public function setNumberCountryId($id): static
    {
        $value = !is_null($id)
            ? new CountryDto($id)
            : null;

        return $this->setNumberCountry($value);
    }

    public function getNumberCountryId()
    {
        if ($dto = $this->getNumberCountry()) {
            return $dto->getId();
        }

        return null;
    }

}
