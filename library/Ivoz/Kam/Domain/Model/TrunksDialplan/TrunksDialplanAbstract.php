<?php

namespace Ivoz\Kam\Domain\Model\TrunksDialplan;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * TrunksDialplanAbstract
 * @codeCoverageIgnore
 */
abstract class TrunksDialplanAbstract
{
    /**
     * @var integer
     */
    protected $dpid;

    /**
     * @var integer
     */
    protected $pr;

    /**
     * @column match_op
     * @var integer
     */
    protected $matchOp;

    /**
     * @column match_exp
     * @var string
     */
    protected $matchExp;

    /**
     * @column match_len
     * @var integer
     */
    protected $matchLen;

    /**
     * @column subst_exp
     * @var string
     */
    protected $substExp;

    /**
     * @column repl_exp
     * @var string
     */
    protected $replExp;

    /**
     * @var string
     */
    protected $attrs;

    /**
     * @var \Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkInterface
     */
    protected $transformationRulesetGroupsTrunk;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct(
        $dpid,
        $pr,
        $matchOp,
        $matchExp,
        $matchLen,
        $substExp,
        $replExp,
        $attrs
    ) {
        $this->setDpid($dpid);
        $this->setPr($pr);
        $this->setMatchOp($matchOp);
        $this->setMatchExp($matchExp);
        $this->setMatchLen($matchLen);
        $this->setSubstExp($substExp);
        $this->setReplExp($replExp);
        $this->setAttrs($attrs);

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
     * @return TrunksDialplanDTO
     */
    public static function createDTO()
    {
        return new TrunksDialplanDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksDialplanDTO
         */
        Assertion::isInstanceOf($dto, TrunksDialplanDTO::class);

        $self = new static(
            $dto->getDpid(),
            $dto->getPr(),
            $dto->getMatchOp(),
            $dto->getMatchExp(),
            $dto->getMatchLen(),
            $dto->getSubstExp(),
            $dto->getReplExp(),
            $dto->getAttrs());

        return $self
            ->setTransformationRulesetGroupsTrunk($dto->getTransformationRulesetGroupsTrunk())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TrunksDialplanDTO
         */
        Assertion::isInstanceOf($dto, TrunksDialplanDTO::class);

        $this
            ->setDpid($dto->getDpid())
            ->setPr($dto->getPr())
            ->setMatchOp($dto->getMatchOp())
            ->setMatchExp($dto->getMatchExp())
            ->setMatchLen($dto->getMatchLen())
            ->setSubstExp($dto->getSubstExp())
            ->setReplExp($dto->getReplExp())
            ->setAttrs($dto->getAttrs())
            ->setTransformationRulesetGroupsTrunk($dto->getTransformationRulesetGroupsTrunk());


        return $this;
    }

    /**
     * @return TrunksDialplanDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setDpid($this->getDpid())
            ->setPr($this->getPr())
            ->setMatchOp($this->getMatchOp())
            ->setMatchExp($this->getMatchExp())
            ->setMatchLen($this->getMatchLen())
            ->setSubstExp($this->getSubstExp())
            ->setReplExp($this->getReplExp())
            ->setAttrs($this->getAttrs())
            ->setTransformationRulesetGroupsTrunkId($this->getTransformationRulesetGroupsTrunk() ? $this->getTransformationRulesetGroupsTrunk()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'dpid' => $this->getDpid(),
            'pr' => $this->getPr(),
            'matchOp' => $this->getMatchOp(),
            'matchExp' => $this->getMatchExp(),
            'matchLen' => $this->getMatchLen(),
            'substExp' => $this->getSubstExp(),
            'replExp' => $this->getReplExp(),
            'attrs' => $this->getAttrs(),
            'transformationRulesetGroupsTrunkId' => $this->getTransformationRulesetGroupsTrunk() ? $this->getTransformationRulesetGroupsTrunk()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set dpid
     *
     * @param integer $dpid
     *
     * @return self
     */
    public function setDpid($dpid)
    {
        Assertion::notNull($dpid);
        Assertion::integerish($dpid);

        $this->dpid = $dpid;

        return $this;
    }

    /**
     * Get dpid
     *
     * @return integer
     */
    public function getDpid()
    {
        return $this->dpid;
    }

    /**
     * Set pr
     *
     * @param integer $pr
     *
     * @return self
     */
    public function setPr($pr)
    {
        Assertion::notNull($pr);
        Assertion::integerish($pr);

        $this->pr = $pr;

        return $this;
    }

    /**
     * Get pr
     *
     * @return integer
     */
    public function getPr()
    {
        return $this->pr;
    }

    /**
     * Set matchOp
     *
     * @param integer $matchOp
     *
     * @return self
     */
    public function setMatchOp($matchOp)
    {
        Assertion::notNull($matchOp);
        Assertion::integerish($matchOp);

        $this->matchOp = $matchOp;

        return $this;
    }

    /**
     * Get matchOp
     *
     * @return integer
     */
    public function getMatchOp()
    {
        return $this->matchOp;
    }

    /**
     * Set matchExp
     *
     * @param string $matchExp
     *
     * @return self
     */
    public function setMatchExp($matchExp)
    {
        Assertion::notNull($matchExp);
        Assertion::maxLength($matchExp, 64);

        $this->matchExp = $matchExp;

        return $this;
    }

    /**
     * Get matchExp
     *
     * @return string
     */
    public function getMatchExp()
    {
        return $this->matchExp;
    }

    /**
     * Set matchLen
     *
     * @param integer $matchLen
     *
     * @return self
     */
    public function setMatchLen($matchLen)
    {
        Assertion::notNull($matchLen);
        Assertion::integerish($matchLen);

        $this->matchLen = $matchLen;

        return $this;
    }

    /**
     * Get matchLen
     *
     * @return integer
     */
    public function getMatchLen()
    {
        return $this->matchLen;
    }

    /**
     * Set substExp
     *
     * @param string $substExp
     *
     * @return self
     */
    public function setSubstExp($substExp)
    {
        Assertion::notNull($substExp);
        Assertion::maxLength($substExp, 64);

        $this->substExp = $substExp;

        return $this;
    }

    /**
     * Get substExp
     *
     * @return string
     */
    public function getSubstExp()
    {
        return $this->substExp;
    }

    /**
     * Set replExp
     *
     * @param string $replExp
     *
     * @return self
     */
    public function setReplExp($replExp)
    {
        Assertion::notNull($replExp);
        Assertion::maxLength($replExp, 64);

        $this->replExp = $replExp;

        return $this;
    }

    /**
     * Get replExp
     *
     * @return string
     */
    public function getReplExp()
    {
        return $this->replExp;
    }

    /**
     * Set attrs
     *
     * @param string $attrs
     *
     * @return self
     */
    public function setAttrs($attrs)
    {
        Assertion::notNull($attrs);
        Assertion::maxLength($attrs, 64);

        $this->attrs = $attrs;

        return $this;
    }

    /**
     * Get attrs
     *
     * @return string
     */
    public function getAttrs()
    {
        return $this->attrs;
    }

    /**
     * Set transformationRulesetGroupsTrunk
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkInterface $transformationRulesetGroupsTrunk
     *
     * @return self
     */
    public function setTransformationRulesetGroupsTrunk(\Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkInterface $transformationRulesetGroupsTrunk)
    {
        $this->transformationRulesetGroupsTrunk = $transformationRulesetGroupsTrunk;

        return $this;
    }

    /**
     * Get transformationRulesetGroupsTrunk
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunkInterface
     */
    public function getTransformationRulesetGroupsTrunk()
    {
        return $this->transformationRulesetGroupsTrunk;
    }



    // @codeCoverageIgnoreEnd
}

