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
     * @param EntityInterface|null $entity
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
         * @var $dto CompanyServiceDto
         */
        Assertion::isInstanceOf($dto, CompanyServiceDto::class);

        $self = new static(
            $dto->getCode()
        );

        $self
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setService($fkTransformer->transform($dto->getService()))
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
         * @var $dto CompanyServiceDto
         */
        Assertion::isInstanceOf($dto, CompanyServiceDto::class);

        $this
            ->setCode($dto->getCode())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setService($fkTransformer->transform($dto->getService()));



        $this->sanitizeValues();
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
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'serviceId' => self::getService() ? self::getService()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set code
     *
     * @param string $code
     *
     * @return self
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

    /**
     * Set service
     *
     * @param \Ivoz\Provider\Domain\Model\Service\ServiceInterface $service
     *
     * @return self
     */
    public function setService(\Ivoz\Provider\Domain\Model\Service\ServiceInterface $service)
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
