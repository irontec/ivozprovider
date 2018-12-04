<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class ExternalCallFilterWhiteListDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto | null
     */
    private $filter;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListDto | null
     */
    private $matchlist;


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
        return [
            'id' => $this->getId(),
            'filter' => $this->getFilter(),
            'matchlist' => $this->getMatchlist()
        ];
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
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto $filter
     *
     * @return static
     */
    public function setFilter(\Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto $filter = null)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setFilterId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto($id)
            : null;

        return $this->setFilter($value);
    }

    /**
     * @return integer | null
     */
    public function getFilterId()
    {
        if ($dto = $this->getFilter()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListDto $matchlist
     *
     * @return static
     */
    public function setMatchlist(\Ivoz\Provider\Domain\Model\MatchList\MatchListDto $matchlist = null)
    {
        $this->matchlist = $matchlist;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListDto
     */
    public function getMatchlist()
    {
        return $this->matchlist;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setMatchlistId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\MatchList\MatchListDto($id)
            : null;

        return $this->setMatchlist($value);
    }

    /**
     * @return integer | null
     */
    public function getMatchlistId()
    {
        if ($dto = $this->getMatchlist()) {
            return $dto->getId();
        }

        return null;
    }
}
