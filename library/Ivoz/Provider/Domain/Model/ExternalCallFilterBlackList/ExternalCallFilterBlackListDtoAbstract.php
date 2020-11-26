<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto;
use Ivoz\Provider\Domain\Model\MatchList\MatchListDto;

/**
* ExternalCallFilterBlackListDtoAbstract
* @codeCoverageIgnore
*/
abstract class ExternalCallFilterBlackListDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $id;

    /**
     * @var ExternalCallFilterDto | null
     */
    private $filter;

    /**
     * @var MatchListDto | null
     */
    private $matchlist;

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
            'id' => 'id',
            'filterId' => 'filter',
            'matchlistId' => 'matchlist'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'id' => $this->getId(),
            'filter' => $this->getFilter(),
            'matchlist' => $this->getMatchlist()
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
     * @param ExternalCallFilterDto | null
     *
     * @return static
     */
    public function setFilter(?ExternalCallFilterDto $filter = null): self
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * @return ExternalCallFilterDto | null
     */
    public function getFilter(): ?ExternalCallFilterDto
    {
        return $this->filter;
    }

    /**
     * @return static
     */
    public function setFilterId($id): self
    {
        $value = !is_null($id)
            ? new ExternalCallFilterDto($id)
            : null;

        return $this->setFilter($value);
    }

    /**
     * @return mixed | null
     */
    public function getFilterId()
    {
        if ($dto = $this->getFilter()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param MatchListDto | null
     *
     * @return static
     */
    public function setMatchlist(?MatchListDto $matchlist = null): self
    {
        $this->matchlist = $matchlist;

        return $this;
    }

    /**
     * @return MatchListDto | null
     */
    public function getMatchlist(): ?MatchListDto
    {
        return $this->matchlist;
    }

    /**
     * @return static
     */
    public function setMatchlistId($id): self
    {
        $value = !is_null($id)
            ? new MatchListDto($id)
            : null;

        return $this->setMatchlist($value);
    }

    /**
     * @return mixed | null
     */
    public function getMatchlistId()
    {
        if ($dto = $this->getMatchlist()) {
            return $dto->getId();
        }

        return null;
    }

}
