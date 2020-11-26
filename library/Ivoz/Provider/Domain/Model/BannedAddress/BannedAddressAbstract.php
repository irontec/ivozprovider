<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\BannedAddress;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;

/**
* BannedAddressAbstract
* @codeCoverageIgnore
*/
abstract class BannedAddressAbstract
{
    use ChangelogTrait;

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
    protected $aor;

    /**
     * @var string | null
     */
    protected $description;

    /**
     * @var \DateTimeInterface | null
     */
    protected $lastTimeBanned;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CompanyInterface
     */
    protected $company;

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
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, BannedAddressDto::class);

        $self = new static(

        );

        $self
            ->setIp($dto->getIp())
            ->setBlocker($dto->getBlocker())
            ->setAor($dto->getAor())
            ->setDescription($dto->getDescription())
            ->setLastTimeBanned($dto->getLastTimeBanned())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()));

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
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, BannedAddressDto::class);

        $this
            ->setIp($dto->getIp())
            ->setBlocker($dto->getBlocker())
            ->setAor($dto->getAor())
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
            ->setAor(self::getAor())
            ->setDescription(self::getDescription())
            ->setLastTimeBanned(self::getLastTimeBanned())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'ip' => self::getIp(),
            'blocker' => self::getBlocker(),
            'aor' => self::getAor(),
            'description' => self::getDescription(),
            'lastTimeBanned' => self::getLastTimeBanned(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null
        ];
    }

    /**
     * Set ip
     *
     * @param string $ip | null
     *
     * @return static
     */
    protected function setIp(?string $ip = null): BannedAddressInterface
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
    public function getIp(): ?string
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
    protected function setBlocker(?string $blocker = null): BannedAddressInterface
    {
        if (!is_null($blocker)) {
            Assertion::maxLength($blocker, 50, 'blocker value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $blocker,
                [
                    BannedAddressInterface::BLOCKER_ANTIFLOOD,
                    BannedAddressInterface::BLOCKER_IPFILTER,
                ],
                'blockervalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->blocker = $blocker;

        return $this;
    }

    /**
     * Get blocker
     *
     * @return string | null
     */
    public function getBlocker(): ?string
    {
        return $this->blocker;
    }

    /**
     * Set aor
     *
     * @param string $aor | null
     *
     * @return static
     */
    protected function setAor(?string $aor = null): BannedAddressInterface
    {
        if (!is_null($aor)) {
            Assertion::maxLength($aor, 300, 'aor value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->aor = $aor;

        return $this;
    }

    /**
     * Get aor
     *
     * @return string | null
     */
    public function getAor(): ?string
    {
        return $this->aor;
    }

    /**
     * Set description
     *
     * @param string $description | null
     *
     * @return static
     */
    protected function setDescription(?string $description = null): BannedAddressInterface
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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set lastTimeBanned
     *
     * @param \DateTimeInterface $lastTimeBanned | null
     *
     * @return static
     */
    protected function setLastTimeBanned($lastTimeBanned = null): BannedAddressInterface
    {
        if (!is_null($lastTimeBanned)) {
            Assertion::notNull(
                $lastTimeBanned,
                'lastTimeBanned value "%s" is null, but non null value was expected.'
            );
            $lastTimeBanned = DateTimeHelper::createOrFix(
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
     * @return \DateTimeInterface | null
     */
    public function getLastTimeBanned(): ?\DateTimeInterface
    {
        return !is_null($this->lastTimeBanned) ? clone $this->lastTimeBanned : null;
    }

    /**
     * Set brand
     *
     * @param BrandInterface | null
     *
     * @return static
     */
    protected function setBrand(?BrandInterface $brand = null): BannedAddressInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    /**
     * Set company
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    protected function setCompany(?CompanyInterface $company = null): BannedAddressInterface
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

}
