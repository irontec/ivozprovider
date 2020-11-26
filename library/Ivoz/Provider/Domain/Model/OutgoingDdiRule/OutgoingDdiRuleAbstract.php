<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;

/**
* OutgoingDdiRuleAbstract
* @codeCoverageIgnore
*/
abstract class OutgoingDdiRuleAbstract
{
    use ChangelogTrait;

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
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var DdiInterface
     */
    protected $forcedDdi;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $defaultAction
    ) {
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
     * @param OutgoingDdiRuleInterface|null $entity
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

        /** @var OutgoingDdiRuleDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param OutgoingDdiRuleDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, OutgoingDdiRuleDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getDefaultAction()
        );

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setForcedDdi($fkTransformer->transform($dto->getForcedDdi()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param OutgoingDdiRuleDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, OutgoingDdiRuleDto::class);

        $this
            ->setName($dto->getName())
            ->setDefaultAction($dto->getDefaultAction())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setForcedDdi($fkTransformer->transform($dto->getForcedDdi()));

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
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setForcedDdi(Ddi::entityToDto(self::getForcedDdi(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'defaultAction' => self::getDefaultAction(),
            'companyId' => self::getCompany()->getId(),
            'forcedDdiId' => self::getForcedDdi() ? self::getForcedDdi()->getId() : null
        ];
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): OutgoingDdiRuleInterface
    {
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set defaultAction
     *
     * @param string $defaultAction
     *
     * @return static
     */
    protected function setDefaultAction(string $defaultAction): OutgoingDdiRuleInterface
    {
        Assertion::maxLength($defaultAction, 10, 'defaultAction value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $defaultAction,
            [
                OutgoingDdiRuleInterface::DEFAULTACTION_KEEP,
                OutgoingDdiRuleInterface::DEFAULTACTION_FORCE,
            ],
            'defaultActionvalue "%s" is not an element of the valid values: %s'
        );

        $this->defaultAction = $defaultAction;

        return $this;
    }

    /**
     * Get defaultAction
     *
     * @return string
     */
    public function getDefaultAction(): string
    {
        return $this->defaultAction;
    }

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    protected function setCompany(CompanyInterface $company): OutgoingDdiRuleInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

    /**
     * Set forcedDdi
     *
     * @param DdiInterface | null
     *
     * @return static
     */
    protected function setForcedDdi(?DdiInterface $forcedDdi = null): OutgoingDdiRuleInterface
    {
        $this->forcedDdi = $forcedDdi;

        return $this;
    }

    /**
     * Get forcedDdi
     *
     * @return DdiInterface | null
     */
    public function getForcedDdi(): ?DdiInterface
    {
        return $this->forcedDdi;
    }

}
