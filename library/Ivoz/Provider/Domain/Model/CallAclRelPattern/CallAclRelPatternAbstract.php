<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelPattern;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * CallAclRelPatternAbstract
 * @codeCoverageIgnore
 */
abstract class CallAclRelPatternAbstract
{
    /**
     * @var integer
     */
    protected $priority;

    /**
     * @comment enum:allow|deny
     * @var string
     */
    protected $policy;

    /**
     * @var \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface
     */
    protected $callAcl;

    /**
     * @var \Ivoz\Provider\Domain\Model\CallAclPattern\CallAclPatternInterface
     */
    protected $callAclPattern;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($priority, $policy)
    {
        $this->setPriority($priority);
        $this->setPolicy($policy);

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
     * @return CallAclRelPatternDTO
     */
    public static function createDTO()
    {
        return new CallAclRelPatternDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CallAclRelPatternDTO
         */
        Assertion::isInstanceOf($dto, CallAclRelPatternDTO::class);

        $self = new static(
            $dto->getPriority(),
            $dto->getPolicy());

        return $self
            ->setCallAcl($dto->getCallAcl())
            ->setCallAclPattern($dto->getCallAclPattern())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CallAclRelPatternDTO
         */
        Assertion::isInstanceOf($dto, CallAclRelPatternDTO::class);

        $this
            ->setPriority($dto->getPriority())
            ->setPolicy($dto->getPolicy())
            ->setCallAcl($dto->getCallAcl())
            ->setCallAclPattern($dto->getCallAclPattern());


        return $this;
    }

    /**
     * @return CallAclRelPatternDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setPriority($this->getPriority())
            ->setPolicy($this->getPolicy())
            ->setCallAclId($this->getCallAcl() ? $this->getCallAcl()->getId() : null)
            ->setCallAclPatternId($this->getCallAclPattern() ? $this->getCallAclPattern()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'priority' => $this->getPriority(),
            'policy' => $this->getPolicy(),
            'callAclId' => $this->getCallAcl() ? $this->getCallAcl()->getId() : null,
            'callAclPatternId' => $this->getCallAclPattern() ? $this->getCallAclPattern()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    public function setPriority($priority)
    {
        Assertion::notNull($priority);
        Assertion::integerish($priority);

        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set policy
     *
     * @param string $policy
     *
     * @return self
     */
    public function setPolicy($policy)
    {
        Assertion::notNull($policy);
        Assertion::maxLength($policy, 25);
        Assertion::choice($policy, array (
          0 => 'allow',
          1 => 'deny',
        ));

        $this->policy = $policy;

        return $this;
    }

    /**
     * Get policy
     *
     * @return string
     */
    public function getPolicy()
    {
        return $this->policy;
    }

    /**
     * Set callAcl
     *
     * @param \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl
     *
     * @return self
     */
    public function setCallAcl(\Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface $callAcl = null)
    {
        $this->callAcl = $callAcl;

        return $this;
    }

    /**
     * Get callAcl
     *
     * @return \Ivoz\Provider\Domain\Model\CallAcl\CallAclInterface
     */
    public function getCallAcl()
    {
        return $this->callAcl;
    }

    /**
     * Set callAclPattern
     *
     * @param \Ivoz\Provider\Domain\Model\CallAclPattern\CallAclPatternInterface $callAclPattern
     *
     * @return self
     */
    public function setCallAclPattern(\Ivoz\Provider\Domain\Model\CallAclPattern\CallAclPatternInterface $callAclPattern)
    {
        $this->callAclPattern = $callAclPattern;

        return $this;
    }

    /**
     * Get callAclPattern
     *
     * @return \Ivoz\Provider\Domain\Model\CallAclPattern\CallAclPatternInterface
     */
    public function getCallAclPattern()
    {
        return $this->callAclPattern;
    }



    // @codeCoverageIgnoreEnd
}

