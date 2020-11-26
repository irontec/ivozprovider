<?php
declare(strict_types = 1);

namespace Ivoz\Kam\Domain\Model\UsersAddress;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\Company;

/**
* UsersAddressAbstract
* @codeCoverageIgnore
*/
abstract class UsersAddressAbstract
{
    use ChangelogTrait;

    /**
     * column: source_address
     * @var string
     */
    protected $sourceAddress;

    /**
     * column: ip_addr
     * @var string | null
     */
    protected $ipAddr;

    /**
     * @var int
     */
    protected $mask = 32;

    /**
     * @var int
     */
    protected $port = 0;

    /**
     * @var string | null
     */
    protected $tag;

    /**
     * @var string | null
     */
    protected $description;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * Constructor
     */
    protected function __construct(
        $sourceAddress,
        $mask,
        $port
    ) {
        $this->setSourceAddress($sourceAddress);
        $this->setMask($mask);
        $this->setPort($port);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "UsersAddress",
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
     * @return UsersAddressDto
     */
    public static function createDto($id = null)
    {
        return new UsersAddressDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param UsersAddressInterface|null $entity
     * @param int $depth
     * @return UsersAddressDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, UsersAddressInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var UsersAddressDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param UsersAddressDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersAddressDto::class);

        $self = new static(
            $dto->getSourceAddress(),
            $dto->getMask(),
            $dto->getPort()
        );

        $self
            ->setIpAddr($dto->getIpAddr())
            ->setTag($dto->getTag())
            ->setDescription($dto->getDescription())
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param UsersAddressDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, UsersAddressDto::class);

        $this
            ->setSourceAddress($dto->getSourceAddress())
            ->setIpAddr($dto->getIpAddr())
            ->setMask($dto->getMask())
            ->setPort($dto->getPort())
            ->setTag($dto->getTag())
            ->setDescription($dto->getDescription())
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return UsersAddressDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setSourceAddress(self::getSourceAddress())
            ->setIpAddr(self::getIpAddr())
            ->setMask(self::getMask())
            ->setPort(self::getPort())
            ->setTag(self::getTag())
            ->setDescription(self::getDescription())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'source_address' => self::getSourceAddress(),
            'ip_addr' => self::getIpAddr(),
            'mask' => self::getMask(),
            'port' => self::getPort(),
            'tag' => self::getTag(),
            'description' => self::getDescription(),
            'companyId' => self::getCompany()->getId()
        ];
    }

    /**
     * Set sourceAddress
     *
     * @param string $sourceAddress
     *
     * @return static
     */
    protected function setSourceAddress(string $sourceAddress): UsersAddressInterface
    {
        Assertion::maxLength($sourceAddress, 100, 'sourceAddress value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->sourceAddress = $sourceAddress;

        return $this;
    }

    /**
     * Get sourceAddress
     *
     * @return string
     */
    public function getSourceAddress(): string
    {
        return $this->sourceAddress;
    }

    /**
     * Set ipAddr
     *
     * @param string $ipAddr | null
     *
     * @return static
     */
    protected function setIpAddr(?string $ipAddr = null): UsersAddressInterface
    {
        if (!is_null($ipAddr)) {
            Assertion::maxLength($ipAddr, 50, 'ipAddr value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ipAddr = $ipAddr;

        return $this;
    }

    /**
     * Get ipAddr
     *
     * @return string | null
     */
    public function getIpAddr(): ?string
    {
        return $this->ipAddr;
    }

    /**
     * Set mask
     *
     * @param int $mask
     *
     * @return static
     */
    protected function setMask(int $mask): UsersAddressInterface
    {
        $this->mask = $mask;

        return $this;
    }

    /**
     * Get mask
     *
     * @return int
     */
    public function getMask(): int
    {
        return $this->mask;
    }

    /**
     * Set port
     *
     * @param int $port
     *
     * @return static
     */
    protected function setPort(int $port): UsersAddressInterface
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * Set tag
     *
     * @param string $tag | null
     *
     * @return static
     */
    protected function setTag(?string $tag = null): UsersAddressInterface
    {
        if (!is_null($tag)) {
            Assertion::maxLength($tag, 64, 'tag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string | null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * Set description
     *
     * @param string $description | null
     *
     * @return static
     */
    protected function setDescription(?string $description = null): UsersAddressInterface
    {
        if (!is_null($description)) {
            Assertion::maxLength($description, 200, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    protected function setCompany(CompanyInterface $company): UsersAddressInterface
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

}
