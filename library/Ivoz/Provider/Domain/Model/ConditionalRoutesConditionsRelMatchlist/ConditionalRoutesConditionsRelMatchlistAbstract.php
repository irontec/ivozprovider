<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * ConditionalRoutesConditionsRelMatchlistAbstract
 * @codeCoverageIgnore
 */
abstract class ConditionalRoutesConditionsRelMatchlistAbstract
{
    /**
     * @var \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface
     */
    protected $condition;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    protected $matchlist;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $this->_initialValues = $this->__toArray();
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
     * @return ConditionalRoutesConditionsRelMatchlistDTO
     */
    public static function createDTO()
    {
        return new ConditionalRoutesConditionsRelMatchlistDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ConditionalRoutesConditionsRelMatchlistDTO
         */
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelMatchlistDTO::class);

        $self = new static();

        return $self
            ->setCondition($dto->getCondition())
            ->setMatchlist($dto->getMatchlist())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ConditionalRoutesConditionsRelMatchlistDTO
         */
        Assertion::isInstanceOf($dto, ConditionalRoutesConditionsRelMatchlistDTO::class);

        $this
            ->setCondition($dto->getCondition())
            ->setMatchlist($dto->getMatchlist());


        return $this;
    }

    /**
     * @return ConditionalRoutesConditionsRelMatchlistDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setConditionId($this->getCondition() ? $this->getCondition()->getId() : null)
            ->setMatchlistId($this->getMatchlist() ? $this->getMatchlist()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'conditionId' => $this->getCondition() ? $this->getCondition()->getId() : null,
            'matchlistId' => $this->getMatchlist() ? $this->getMatchlist()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set condition
     *
     * @param \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface $condition
     *
     * @return self
     */
    public function setCondition(\Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface $condition = null)
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * Get condition
     *
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Set matchlist
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchlist
     *
     * @return self
     */
    public function setMatchlist(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchlist)
    {
        $this->matchlist = $matchlist;

        return $this;
    }

    /**
     * Get matchlist
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    public function getMatchlist()
    {
        return $this->matchlist;
    }



    // @codeCoverageIgnoreEnd
}

