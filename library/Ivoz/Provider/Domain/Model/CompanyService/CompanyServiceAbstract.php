<?php

namespace Ivoz\Provider\Domain\Model\CompanyService;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CompanyServiceAbstract
 * @codeCoverageIgnore
 */
abstract class CompanyServiceAbstract
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Service\ServiceInterface
     */
    protected $service;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($code)
    {
        $this->setCode($code);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "CompanyService",
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
     * @return CompanyServiceDto
     */
    public static function createDto($id = null)
    {
        return new CompanyServiceDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyServiceInterface|null $entity
     * @param int $depth
     * @return CompanyServiceDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CompanyServiceInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var CompanyServiceDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CompanyServiceDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CompanyServiceDto::class);

        $self = new static(
            $dto->getCode()
        );

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setService($fkTransformer->transform($dto->getService()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CompanyServiceDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CompanyServiceDto::class);

        $this
            ->setCode($dto->getCode())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setService($fkTransformer->transform($dto->getService()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CompanyServiceDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCode(self::getCode())
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setService(\Ivoz\Provider\Domain\Model\Service\Service::entityToDto(self::getService(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'code' => self::getCode(),
            'companyId' => self::getCompany()->getId(),
            'serviceId' => self::getService()->getId()
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set code
     *
     * @param string $code
     *
     * @return static
     */
    protected function setCode($code)
    {
        Assertion::notNull($code, 'code value "%s" is null, but non null value was expected.');
        Assertion::maxLength($code, 3, 'code value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return static
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
     * Set service
     *
     * @param \Ivoz\Provider\Domain\Model\Service\ServiceInterface $service
     *
     * @return static
     */
    protected function setService(\Ivoz\Provider\Domain\Model\Service\ServiceInterface $service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \Ivoz\Provider\Domain\Model\Service\ServiceInterface
     */
    public function getService()
    {
        return $this->service;
    }

    // @codeCoverageIgnoreEnd
}
