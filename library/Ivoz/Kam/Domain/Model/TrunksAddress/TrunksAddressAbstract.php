<?php

namespace Ivoz\Kam\Domain\Model\TrunksAddress;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TrunksAddressAbstract
 * @codeCoverageIgnore
 */
abstract class TrunksAddressAbstract
{
    /**
     * @var integer
     */
    protected $grp = '1';

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
     * @var \Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface
     */
    protected $ddiProviderAddress;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($grp, $mask, $port)
    {
        $this->setGrp($grp);
        $this->setMask($mask);
        $this->setPort($port);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TrunksAddress",
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
     * @return TrunksAddressDto
     */
    public static function createDto($id = null)
    {
        return new TrunksAddressDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TrunksAddressDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TrunksAddressInterface::class);

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
         * @var $dto TrunksAddressDto
         */
        Assertion::isInstanceOf($dto, TrunksAddressDto::class);

        $self = new static(
            $dto->getGrp(),
            $dto->getMask(),
            $dto->getPort()
        );

        $self
            ->setIpAddr($dto->getIpAddr())
            ->setTag($dto->getTag())
            ->setDdiProviderAddress($dto->getDdiProviderAddress())
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
         * @var $dto TrunksAddressDto
         */
        Assertion::isInstanceOf($dto, TrunksAddressDto::class);

        $this
            ->setGrp($dto->getGrp())
            ->setIpAddr($dto->getIpAddr())
            ->setMask($dto->getMask())
            ->setPort($dto->getPort())
            ->setTag($dto->getTag())
            ->setDdiProviderAddress($dto->getDdiProviderAddress());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TrunksAddressDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setGrp(self::getGrp())
            ->setIpAddr(self::getIpAddr())
            ->setMask(self::getMask())
            ->setPort(self::getPort())
            ->setTag(self::getTag())
            ->setDdiProviderAddress(\Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddress::entityToDto(self::getDdiProviderAddress(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'grp' => self::getGrp(),
            'ip_addr' => self::getIpAddr(),
            'mask' => self::getMask(),
            'port' => self::getPort(),
            'tag' => self::getTag(),
            'ddiProviderAddressId' => self::getDdiProviderAddress() ? self::getDdiProviderAddress()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * @deprecated
     * Set grp
     *
     * @param integer $grp
     *
     * @return self
     */
    public function setGrp($grp)
    {
        Assertion::notNull($grp, 'grp value "%s" is null, but non null value was expected.');
        Assertion::integerish($grp, 'grp value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($grp, 0, 'grp provided "%s" is not greater or equal than "%s".');

        $this->grp = $grp;

        return $this;
    }

    /**
     * Get grp
     *
     * @return integer
     */
    public function getGrp()
    {
        return $this->grp;
    }

    /**
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * @deprecated
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
     * Set ddiProviderAddress
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface $ddiProviderAddress
     *
     * @return self
     */
    public function setDdiProviderAddress(\Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface $ddiProviderAddress)
    {
        $this->ddiProviderAddress = $ddiProviderAddress;

        return $this;
    }

    /**
     * Get ddiProviderAddress
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface
     */
    public function getDdiProviderAddress()
    {
        return $this->ddiProviderAddress;
    }

    // @codeCoverageIgnoreEnd
}
