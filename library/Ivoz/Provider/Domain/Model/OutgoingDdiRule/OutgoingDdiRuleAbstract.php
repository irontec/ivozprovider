<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * OutgoingDdiRuleAbstract
 * @codeCoverageIgnore
 */
abstract class OutgoingDdiRuleAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @comment enum:keep|force
     * @var string
     */
    protected $defaultAction;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    protected $forcedDdi;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($name, $defaultAction)
    {
        $this->setName($name);
        $this->setDefaultAction($defaultAction);
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
     * @return OutgoingDdiRuleDTO
     */
    public static function createDTO()
    {
        return new OutgoingDdiRuleDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto OutgoingDdiRuleDTO
         */
        Assertion::isInstanceOf($dto, OutgoingDdiRuleDTO::class);

        $self = new static(
            $dto->getName(),
            $dto->getDefaultAction());

        return $self
            ->setCompany($dto->getCompany())
            ->setForcedDdi($dto->getForcedDdi())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto OutgoingDdiRuleDTO
         */
        Assertion::isInstanceOf($dto, OutgoingDdiRuleDTO::class);

        $this
            ->setName($dto->getName())
            ->setDefaultAction($dto->getDefaultAction())
            ->setCompany($dto->getCompany())
            ->setForcedDdi($dto->getForcedDdi());


        return $this;
    }

    /**
     * @return OutgoingDdiRuleDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setName($this->getName())
            ->setDefaultAction($this->getDefaultAction())
            ->setCompanyId($this->getCompany() ? $this->getCompany()->getId() : null)
            ->setForcedDdiId($this->getForcedDdi() ? $this->getForcedDdi()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => $this->getName(),
            'defaultAction' => $this->getDefaultAction(),
            'companyId' => $this->getCompany() ? $this->getCompany()->getId() : null,
            'forcedDdiId' => $this->getForcedDdi() ? $this->getForcedDdi()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        Assertion::notNull($name);
        Assertion::maxLength($name, 50);

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set defaultAction
     *
     * @param string $defaultAction
     *
     * @return self
     */
    public function setDefaultAction($defaultAction)
    {
        Assertion::notNull($defaultAction);
        Assertion::maxLength($defaultAction, 10);
        Assertion::choice($defaultAction, array (
          0 => 'keep',
          1 => 'force',
        ));

        $this->defaultAction = $defaultAction;

        return $this;
    }

    /**
     * Get defaultAction
     *
     * @return string
     */
    public function getDefaultAction()
    {
        return $this->defaultAction;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set forcedDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $forcedDdi
     *
     * @return self
     */
    public function setForcedDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $forcedDdi = null)
    {
        $this->forcedDdi = $forcedDdi;

        return $this;
    }

    /**
     * Get forcedDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getForcedDdi()
    {
        return $this->forcedDdi;
    }



    // @codeCoverageIgnoreEnd
}

