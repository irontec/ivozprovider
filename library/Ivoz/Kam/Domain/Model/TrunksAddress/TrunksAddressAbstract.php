<?php
declare(strict_types = 1);

namespace Ivoz\Kam\Domain\Model\TrunksAddress;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddress;

/**
* TrunksAddressAbstract
* @codeCoverageIgnore
*/
abstract class TrunksAddressAbstract
{
    use ChangelogTrait;

    /**
     * @var int
     */
    protected $grp = 1;

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
     * @var DdiProviderAddress
     * inversedBy trunksAddress
     */
    protected $ddiProviderAddress;

    /**
     * Constructor
     */
    protected function __construct(
        $grp,
        $mask,
        $port
    ) {
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
     * @param TrunksAddressInterface|null $entity
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

        /** @var TrunksAddressDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TrunksAddressDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TrunksAddressDto::class);

        $self = new static(
            $dto->getGrp(),
            $dto->getMask(),
            $dto->getPort()
        );

        $self
            ->setIpAddr($dto->getIpAddr())
            ->setTag($dto->getTag())
            ->setDdiProviderAddress($fkTransformer->transform($dto->getDdiProviderAddress()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TrunksAddressDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TrunksAddressDto::class);

        $this
            ->setGrp($dto->getGrp())
            ->setIpAddr($dto->getIpAddr())
            ->setMask($dto->getMask())
            ->setPort($dto->getPort())
            ->setTag($dto->getTag())
            ->setDdiProviderAddress($fkTransformer->transform($dto->getDdiProviderAddress()));

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
            ->setDdiProviderAddress(DdiProviderAddress::entityToDto(self::getDdiProviderAddress(), $depth));
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
            'ddiProviderAddressId' => self::getDdiProviderAddress()->getId()
        ];
    }

    /**
     * Set grp
     *
     * @param int $grp
     *
     * @return static
     */
    protected function setGrp(int $grp): TrunksAddressInterface
    {
        Assertion::greaterOrEqualThan($grp, 0, 'grp provided "%s" is not greater or equal than "%s".');

        $this->grp = $grp;

        return $this;
    }

    /**
     * Get grp
     *
     * @return int
     */
    public function getGrp(): int
    {
        return $this->grp;
    }

    /**
     * Set ipAddr
     *
     * @param string $ipAddr | null
     *
     * @return static
     */
    protected function setIpAddr(?string $ipAddr = null): TrunksAddressInterface
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
    protected function setMask(int $mask): TrunksAddressInterface
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
    protected function setPort(int $port): TrunksAddressInterface
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
    protected function setTag(?string $tag = null): TrunksAddressInterface
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
     * Set ddiProviderAddress
     *
     * @param DdiProviderAddress
     *
     * @return static
     */
    public function setDdiProviderAddress(DdiProviderAddress $ddiProviderAddress): TrunksAddressInterface
    {
        $this->ddiProviderAddress = $ddiProviderAddress;

        return $this;
    }

    /**
     * Get ddiProviderAddress
     *
     * @return DdiProviderAddress
     */
    public function getDdiProviderAddress(): DdiProviderAddress
    {
        return $this->ddiProviderAddress;
    }

}
