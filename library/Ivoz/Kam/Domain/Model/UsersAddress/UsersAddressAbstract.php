<?php

namespace Ivoz\Kam\Domain\Model\UsersAddress;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * UsersAddressAbstract
 * @codeCoverageIgnore
 */
abstract class UsersAddressAbstract
{
    /**
     * column: source_address
     * @var string
     */
    protected $sourceAddress;

    /**
     * column: ip_addr
     * @var string
     */
    protected $ipAddr;

    /**
     * @var integer
     */
    protected $mask = '32';

    /**
     * @var integer
     */
    protected $port = '0';

    /**
     * @var string
     */
    protected $tag;

    /**
     * @var string
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
    protected function __construct($sourceAddress, $mask, $port)
    {
        $this->setSourceAddress($sourceAddress);
        $this->setMask($mask);
        $this->setPort($port);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
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
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersAddressDto
         */
        Assertion::isInstanceOf($dto, UsersAddressDto::class);

        $self = new static(
            $dto->getSourceAddress(),
            $dto->getMask(),
            $dto->getPort());

        $self
            ->setIpAddr($dto->getIpAddr())
            ->setTag($dto->getTag())
            ->setDescription($dto->getDescription())
            ->setCompany($dto->getCompany())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto UsersAddressDto
         */
        Assertion::isInstanceOf($dto, UsersAddressDto::class);

        $this
            ->setSourceAddress($dto->getSourceAddress())
            ->setIpAddr($dto->getIpAddr())
            ->setMask($dto->getMask())
            ->setPort($dto->getPort())
            ->setTag($dto->getTag())
            ->setDescription($dto->getDescription())
            ->setCompany($dto->getCompany());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return UsersAddressDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setSourceAddress($this->getSourceAddress())
            ->setIpAddr($this->getIpAddr())
            ->setMask($this->getMask())
            ->setPort($this->getPort())
            ->setTag($this->getTag())
            ->setDescription($this->getDescription())
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto($this->getCompany(), $depth));
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
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set sourceAddress
     *
     * @param string $sourceAddress
     *
     * @return self
     */
    public function setSourceAddress($sourceAddress)
    {
        Assertion::notNull($sourceAddress, 'sourceAddress value "%s" is null, but non null value was expected.');
        Assertion::maxLength($sourceAddress, 100, 'sourceAddress value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->sourceAddress = $sourceAddress;

        return $this;
    }

    /**
     * Get sourceAddress
     *
     * @return string
     */
    public function getSourceAddress()
    {
        return $this->sourceAddress;
    }

    /**
     * Set ipAddr
     *
     * @param string $ipAddr
     *
     * @return self
     */
    public function setIpAddr($ipAddr = null)
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
     * @return string
     */
    public function getIpAddr()
    {
        return $this->ipAddr;
    }

    /**
     * Set mask
     *
     * @param integer $mask
     *
     * @return self
     */
    public function setMask($mask)
    {
        Assertion::notNull($mask, 'mask value "%s" is null, but non null value was expected.');
        Assertion::integerish($mask, 'mask value "%s" is not an integer or a number castable to integer.');

        $this->mask = $mask;

        return $this;
    }

    /**
     * Get mask
     *
     * @return integer
     */
    public function getMask()
    {
        return $this->mask;
    }

    /**
     * Set port
     *
     * @param integer $port
     *
     * @return self
     */
    public function setPort($port)
    {
        Assertion::notNull($port, 'port value "%s" is null, but non null value was expected.');
        Assertion::integerish($port, 'port value "%s" is not an integer or a number castable to integer.');

        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return integer
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag = null)
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
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description = null)
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
     * @return string
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

