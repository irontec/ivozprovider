<?php

namespace Ivoz\Provider\Domain\Model\BannedAddress;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * BannedAddressAbstract
 * @codeCoverageIgnore
 */
abstract class BannedAddressAbstract
{
    /**
     * @var string | null
     */
    protected $ip;

    /**
     * comment: enum:antiflood|ipfilter
     * @var string | null
     */
    protected $blocker;

    /**
     * @var string | null
     */
    protected $description;

    /**
     * @var \DateTime | null
     */
    protected $lastTimeBanned;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    protected $company;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "BannedAddress",
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
     * @return BannedAddressDto
     */
    public static function createDto($id = null)
    {
        return new BannedAddressDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param BannedAddressInterface|null $entity
     * @param int $depth
     * @return BannedAddressDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, BannedAddressInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var BannedAddressDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param BannedAddressDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, BannedAddressDto::class);

        $self = new static();

        $self
            ->setIp($dto->getIp())
            ->setBlocker($dto->getBlocker())
            ->setDescription($dto->getDescription())
            ->setLastTimeBanned($dto->getLastTimeBanned())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param BannedAddressDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, BannedAddressDto::class);

        $this
            ->setIp($dto->getIp())
            ->setBlocker($dto->getBlocker())
            ->setDescription($dto->getDescription())
            ->setLastTimeBanned($dto->getLastTimeBanned())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return BannedAddressDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setIp(self::getIp())
            ->setBlocker(self::getBlocker())
            ->setDescription(self::getDescription())
            ->setLastTimeBanned(self::getLastTimeBanned())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'ip' => self::getIp(),
            'blocker' => self::getBlocker(),
            'description' => self::getDescription(),
            'lastTimeBanned' => self::getLastTimeBanned(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set ip
     *
     * @param string $ip | null
     *
     * @return static
     */
    protected function setIp($ip = null)
    {
        if (!is_null($ip)) {
            Assertion::maxLength($ip, 50, 'ip value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string | null
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set blocker
     *
     * @param string $blocker | null
     *
     * @return static
     */
    protected function setBlocker($blocker = null)
    {
        if (!is_null($blocker)) {
            Assertion::maxLength($blocker, 50, 'blocker value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($blocker, [
                BannedAddressInterface::BLOCKER_ANTIFLOOD,
                BannedAddressInterface::BLOCKER_IPFILTER
            ], 'blockervalue "%s" is not an element of the valid values: %s');
        }

        $this->blocker = $blocker;

        return $this;
    }

    /**
     * Get blocker
     *
     * @return string | null
     */
    public function getBlocker()
    {
        return $this->blocker;
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
            Assertion::maxLength($description, 100, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * Set lastTimeBanned
     *
     * @param \DateTime $lastTimeBanned | null
     *
     * @return static
     */
    protected function setLastTimeBanned($lastTimeBanned = null)
    {
        if (!is_null($lastTimeBanned)) {
            $lastTimeBanned = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
                $lastTimeBanned,
                null
            );

            if ($this->lastTimeBanned == $lastTimeBanned) {
                return $this;
            }
        }

        $this->lastTimeBanned = $lastTimeBanned;

        return $this;
    }

    /**
     * Get lastTimeBanned
     *
     * @return \DateTime | null
     */
    public function getLastTimeBanned()
    {
        return !is_null($this->lastTimeBanned) ? clone $this->lastTimeBanned : null;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand | null
     *
     * @return static
     */
    protected function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company | null
     *
     * @return static
     */
    protected function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    // @codeCoverageIgnoreEnd
}
