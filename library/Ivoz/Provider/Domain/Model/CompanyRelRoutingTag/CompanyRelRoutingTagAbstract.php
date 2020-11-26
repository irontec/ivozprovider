<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\CompanyRelRoutingTag;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTag;

/**
* CompanyRelRoutingTagAbstract
* @codeCoverageIgnore
*/
abstract class CompanyRelRoutingTagAbstract
{
    use ChangelogTrait;

    /**
     * @var CompanyInterface
     * inversedBy relRoutingTags
     */
    protected $company;

    /**
     * @var RoutingTagInterface
     * inversedBy relCompanies
     */
    protected $routingTag;

    /**
     * Constructor
     */
    protected function __construct(

    ) {

    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "CompanyRelRoutingTag",
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
     * @return CompanyRelRoutingTagDto
     */
    public static function createDto($id = null)
    {
        return new CompanyRelRoutingTagDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyRelRoutingTagInterface|null $entity
     * @param int $depth
     * @return CompanyRelRoutingTagDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CompanyRelRoutingTagInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var CompanyRelRoutingTagDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyRelRoutingTagDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CompanyRelRoutingTagDto::class);

        $self = new static(

        );

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setRoutingTag($fkTransformer->transform($dto->getRoutingTag()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyRelRoutingTagDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CompanyRelRoutingTagDto::class);

        $this
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setRoutingTag($fkTransformer->transform($dto->getRoutingTag()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CompanyRelRoutingTagDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setRoutingTag(RoutingTag::entityToDto(self::getRoutingTag(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'routingTagId' => self::getRoutingTag()->getId()
        ];
    }

    /**
     * Set company
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    public function setCompany(?CompanyInterface $company = null): CompanyRelRoutingTagInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    /**
     * Set routingTag
     *
     * @param RoutingTagInterface
     *
     * @return static
     */
    public function setRoutingTag(RoutingTagInterface $routingTag): CompanyRelRoutingTagInterface
    {
        $this->routingTag = $routingTag;

        return $this;
    }

    /**
     * Get routingTag
     *
     * @return RoutingTagInterface
     */
    public function getRoutingTag(): RoutingTagInterface
    {
        return $this->routingTag;
    }

}
