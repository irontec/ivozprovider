<?php

namespace Ivoz\Provider\Domain\Model\Location;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * LocationAbstract
 * @codeCoverageIgnore
 */
abstract class LocationAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string | null
     */
    protected $description;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($name)
    {
        $this->setName($name);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Location",
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
     * @return LocationDto
     */
    public static function createDto($id = null)
    {
        return new LocationDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param LocationInterface|null $entity
     * @param int $depth
     * @return LocationDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, LocationInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var LocationDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param LocationDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, LocationDto::class);

        $self = new static(
            $dto->getName()
        );

        $self
            ->setDescription($dto->getDescription())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param LocationDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, LocationDto::class);

        $this
            ->setName($dto->getName())
            ->setDescription($dto->getDescription())
            ->setCompany($fkTransformer->transform($dto->getCompany()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return LocationDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDescription(self::getDescription())
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'description' => self::getDescription(),
            'companyId' => self::getCompany()->getId()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description | null
     *
     * @return static
     */
    protected function setDescription($description = null)
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
     */
    protected function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
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
