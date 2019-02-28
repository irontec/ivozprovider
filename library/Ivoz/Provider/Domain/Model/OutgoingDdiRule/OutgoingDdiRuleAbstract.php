<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * OutgoingDdiRuleAbstract
 * @codeCoverageIgnore
 */
abstract class OutgoingDdiRuleAbstract
{
    const DEFAULTACTION_KEEP = 'keep';
    const DEFAULTACTION_FORCE = 'force';

    /**
     * @var string
     */
    protected $name;

    /**
     * comment: enum:keep|force
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


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($name, $defaultAction)
    {
        $this->setName($name);
        $this->setDefaultAction($defaultAction);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "OutgoingDdiRule",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return OutgoingDdiRuleDto
     */
    public static function createDto($id = null)
    {
        return new OutgoingDdiRuleDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return OutgoingDdiRuleDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, OutgoingDdiRuleInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto OutgoingDdiRuleDto
         */
        Assertion::isInstanceOf($dto, OutgoingDdiRuleDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getDefaultAction()
        );

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setForcedDdi($fkTransformer->transform($dto->getForcedDdi()))
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto OutgoingDdiRuleDto
         */
        Assertion::isInstanceOf($dto, OutgoingDdiRuleDto::class);

        $this
            ->setName($dto->getName())
            ->setDefaultAction($dto->getDefaultAction())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setForcedDdi($fkTransformer->transform($dto->getForcedDdi()));



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return OutgoingDdiRuleDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDefaultAction(self::getDefaultAction())
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setForcedDdi(\Ivoz\Provider\Domain\Model\Ddi\Ddi::entityToDto(self::getForcedDdi(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'defaultAction' => self::getDefaultAction(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'forcedDdiId' => self::getForcedDdi() ? self::getForcedDdi()->getId() : null
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
    protected function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
    protected function setDefaultAction($defaultAction)
    {
        Assertion::notNull($defaultAction, 'defaultAction value "%s" is null, but non null value was expected.');
        Assertion::maxLength($defaultAction, 10, 'defaultAction value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($defaultAction, [
            self::DEFAULTACTION_KEEP,
            self::DEFAULTACTION_FORCE
        ], 'defaultActionvalue "%s" is not an element of the valid values: %s');

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
