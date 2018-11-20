<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CallAclAbstract
 * @codeCoverageIgnore
 */
abstract class CallAclAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * comment: enum:allow|deny
     * @var string
     */
    protected $defaultPolicy;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($name, $defaultPolicy)
    {
        $this->setName($name);
        $this->setDefaultPolicy($defaultPolicy);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "CallAcl",
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
     * @return CallAclDto
     */
    public static function createDto($id = null)
    {
        return new CallAclDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return CallAclDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CallAclInterface::class);

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
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CallAclDto
         */
        Assertion::isInstanceOf($dto, CallAclDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getDefaultPolicy()
        );

        $self
            ->setCompany($dto->getCompany())
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
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CallAclDto
         */
        Assertion::isInstanceOf($dto, CallAclDto::class);

        $this
            ->setName($dto->getName())
            ->setDefaultPolicy($dto->getDefaultPolicy())
            ->setCompany($dto->getCompany());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CallAclDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDefaultPolicy(self::getDefaultPolicy())
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'defaultPolicy' => self::getDefaultPolicy(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * @deprecated
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
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
     * @deprecated
     * Set defaultPolicy
     *
     * @param string $defaultPolicy
     *
     * @return self
     */
    public function setDefaultPolicy($defaultPolicy)
    {
        Assertion::notNull($defaultPolicy, 'defaultPolicy value "%s" is null, but non null value was expected.');
        Assertion::maxLength($defaultPolicy, 10, 'defaultPolicy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($defaultPolicy, array (
          0 => 'allow',
          1 => 'deny',
        ), 'defaultPolicyvalue "%s" is not an element of the valid values: %s');

        $this->defaultPolicy = $defaultPolicy;

        return $this;
    }

    /**
     * Get defaultPolicy
     *
     * @return string
     */
    public function getDefaultPolicy()
    {
        return $this->defaultPolicy;
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

    // @codeCoverageIgnoreEnd
}
