<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionDto;
use Ivoz\Provider\Domain\Model\MatchList\MatchListDto;

/**
* ConditionalRoutesConditionsRelMatchlistDtoAbstract
* @codeCoverageIgnore
*/
abstract class ConditionalRoutesConditionsRelMatchlistDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $id;

    /**
     * @var ConditionalRoutesConditionDto | null
     */
    private $condition;

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
            'conditionId' => 'condition',
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
            'condition' => $this->getCondition(),
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

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCondition(?ConditionalRoutesConditionDto $condition): static
    {
        $this->condition = $condition;

        return $this;
    }

    public function getCondition(): ?ConditionalRoutesConditionDto
    {
        return $this->condition;
    }

    public function setConditionId($id): static
    {
        $value = !is_null($id)
            ? new ConditionalRoutesConditionDto($id)
            : null;

        return $this->setCondition($value);
    }

    public function getConditionId()
    {
        if ($dto = $this->getCondition()) {
            return $dto->getId();
        }

        return null;
    }

    public function setMatchlist(?MatchListDto $matchlist): static
    {
        $this->matchlist = $matchlist;

        return $this;
    }

    public function getMatchlist(): ?MatchListDto
    {
        return $this->matchlist;
    }

    public function setMatchlistId($id): static
    {
        $value = !is_null($id)
            ? new MatchListDto($id)
            : null;

        return $this->setMatchlist($value);
    }

    public function getMatchlistId()
    {
        if ($dto = $this->getMatchlist()) {
            return $dto->getId();
        }

        return null;
    }
}
