<?php

namespace Ivoz\Provider\Domain\Model\MatchList;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * MatchListAbstract
 * @codeCoverageIgnore
 */
abstract class MatchListAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;

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
            "MatchList",
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
     * @return MatchListDto
     */
    public static function createDto($id = null)
    {
        return new MatchListDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return MatchListDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, MatchListInterface::class);

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
         * @var $dto MatchListDto
         */
        Assertion::isInstanceOf($dto, MatchListDto::class);

        $self = new static(
            $dto->getName()
        );

        $self
            ->setBrand($dto->getBrand())
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
         * @var $dto MatchListDto
         */
        Assertion::isInstanceOf($dto, MatchListDto::class);

        $this
            ->setName($dto->getName())
            ->setBrand($dto->getBrand())
            ->setCompany($dto->getCompany());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return MatchListDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
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
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
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
