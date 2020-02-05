<?php

namespace Ivoz\Provider\Domain\Model\DdiProviderAddress;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * DdiProviderAddressAbstract
 * @codeCoverageIgnore
 */
abstract class DdiProviderAddressAbstract
{
    /**
     * @var string | null
     */
    protected $ip;

    /**
     * @var string | null
     */
    protected $description;

    /**
     * @var \Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface
     */
    protected $trunksAddress;

    /**
     * @var \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface
     */
    protected $ddiProvider;


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
            "DdiProviderAddress",
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
     * @return DdiProviderAddressDto
     */
    public static function createDto($id = null)
    {
        return new DdiProviderAddressDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param DdiProviderAddressInterface|null $entity
     * @param int $depth
     * @return DdiProviderAddressDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, DdiProviderAddressInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var DdiProviderAddressDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DdiProviderAddressDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, DdiProviderAddressDto::class);

        $self = new static();

        $self
            ->setIp($dto->getIp())
            ->setDescription($dto->getDescription())
            ->setTrunksAddress($fkTransformer->transform($dto->getTrunksAddress()))
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DdiProviderAddressDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, DdiProviderAddressDto::class);

        $this
            ->setIp($dto->getIp())
            ->setDescription($dto->getDescription())
            ->setTrunksAddress($fkTransformer->transform($dto->getTrunksAddress()))
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return DdiProviderAddressDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setIp(self::getIp())
            ->setDescription(self::getDescription())
            ->setTrunksAddress(\Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddress::entityToDto(self::getTrunksAddress(), $depth))
            ->setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider::entityToDto(self::getDdiProvider(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'ip' => self::getIp(),
            'description' => self::getDescription(),
            'trunksAddressId' => self::getTrunksAddress() ? self::getTrunksAddress()->getId() : null,
            'ddiProviderId' => self::getDdiProvider() ? self::getDdiProvider()->getId() : null
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
     * Set description
     *
     * @param string $description | null
     *
     * @return static
     */
    protected function setDescription($description = null)
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set trunksAddress
     *
     * @param \Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface $trunksAddress
     *
     * @return static
     */
    public function setTrunksAddress(\Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface $trunksAddress = null)
    {
        $this->trunksAddress = $trunksAddress;

        return $this;
    }

    /**
     * Get trunksAddress
     *
     * @return \Ivoz\Kam\Domain\Model\TrunksAddress\TrunksAddressInterface
     */
    public function getTrunksAddress()
    {
        return $this->trunksAddress;
    }

    /**
     * Set ddiProvider
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider
     *
     * @return static
     */
    public function setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider = null)
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * Get ddiProvider
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface
     */
    public function getDdiProvider()
    {
        return $this->ddiProvider;
    }

    // @codeCoverageIgnoreEnd
}
