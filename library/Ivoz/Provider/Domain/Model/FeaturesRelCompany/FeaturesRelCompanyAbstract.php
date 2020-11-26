<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\FeaturesRelCompany;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Feature\FeatureInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Feature\Feature;

/**
* FeaturesRelCompanyAbstract
* @codeCoverageIgnore
*/
abstract class FeaturesRelCompanyAbstract
{
    use ChangelogTrait;

    /**
     * @var CompanyInterface
     * inversedBy relFeatures
     */
    protected $company;

    /**
     * @var FeatureInterface
     */
    protected $feature;

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
            "FeaturesRelCompany",
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
     * @return FeaturesRelCompanyDto
     */
    public static function createDto($id = null)
    {
        return new FeaturesRelCompanyDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param FeaturesRelCompanyInterface|null $entity
     * @param int $depth
     * @return FeaturesRelCompanyDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, FeaturesRelCompanyInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var FeaturesRelCompanyDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param FeaturesRelCompanyDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FeaturesRelCompanyDto::class);

        $self = new static(

        );

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setFeature($fkTransformer->transform($dto->getFeature()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param FeaturesRelCompanyDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, FeaturesRelCompanyDto::class);

        $this
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setFeature($fkTransformer->transform($dto->getFeature()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return FeaturesRelCompanyDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setFeature(Feature::entityToDto(self::getFeature(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'featureId' => self::getFeature()->getId()
        ];
    }

    /**
     * Set company
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    public function setCompany(?CompanyInterface $company = null): FeaturesRelCompanyInterface
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
     * Set feature
     *
     * @param FeatureInterface
     *
     * @return static
     */
    protected function setFeature(FeatureInterface $feature): FeaturesRelCompanyInterface
    {
        $this->feature = $feature;

        return $this;
    }

    /**
     * Get feature
     *
     * @return FeatureInterface
     */
    public function getFeature(): FeatureInterface
    {
        return $this->feature;
    }

}
