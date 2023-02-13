<?php

declare(strict_types=1);

namespace Ivoz\Kam\Domain\Model\TrunksLcrGateway;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServer;

/**
* TrunksLcrGatewayAbstract
* @codeCoverageIgnore
*/
abstract class TrunksLcrGatewayAbstract
{
    use ChangelogTrait;

    /**
     * @var int
     * column: lcr_id
     */
    protected $lcrId = 1;

    /**
     * @var string
     * column: gw_name
     */
    protected $gwName;

    /**
     * @var ?string
     */
    protected $ip = null;

    /**
     * @var ?string
     */
    protected $hostname = null;

    /**
     * @var ?int
     */
    protected $port = null;

    /**
     * @var ?string
     */
    protected $params = null;

    /**
     * @var ?int
     * column: uri_scheme
     */
    protected $uriScheme = null;

    /**
     * @var ?int
     */
    protected $transport = null;

    /**
     * @var ?bool
     */
    protected $strip = null;

    /**
     * @var ?string
     */
    protected $prefix = null;

    /**
     * @var ?string
     */
    protected $tag = null;

    /**
     * @var ?int
     */
    protected $defunct = null;

    /**
     * @var ?CarrierServerInterface
     * inversedBy lcrGateway
     */
    protected $carrierServer = null;

    /**
     * Constructor
     */
    protected function __construct(
        int $lcrId,
        string $gwName
    ) {
        $this->setLcrId($lcrId);
        $this->setGwName($gwName);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "TrunksLcrGateway",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): TrunksLcrGatewayDto
    {
        return new TrunksLcrGatewayDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TrunksLcrGatewayInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TrunksLcrGatewayDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TrunksLcrGatewayInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TrunksLcrGatewayDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TrunksLcrGatewayDto::class);
        $lcrId = $dto->getLcrId();
        Assertion::notNull($lcrId, 'getLcrId value is null, but non null value was expected.');
        $gwName = $dto->getGwName();
        Assertion::notNull($gwName, 'getGwName value is null, but non null value was expected.');

        $self = new static(
            $lcrId,
            $gwName
        );

        $self
            ->setIp($dto->getIp())
            ->setHostname($dto->getHostname())
            ->setPort($dto->getPort())
            ->setParams($dto->getParams())
            ->setUriScheme($dto->getUriScheme())
            ->setTransport($dto->getTransport())
            ->setStrip($dto->getStrip())
            ->setPrefix($dto->getPrefix())
            ->setTag($dto->getTag())
            ->setDefunct($dto->getDefunct())
            ->setCarrierServer($fkTransformer->transform($dto->getCarrierServer()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TrunksLcrGatewayDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TrunksLcrGatewayDto::class);

        $lcrId = $dto->getLcrId();
        Assertion::notNull($lcrId, 'getLcrId value is null, but non null value was expected.');
        $gwName = $dto->getGwName();
        Assertion::notNull($gwName, 'getGwName value is null, but non null value was expected.');

        $this
            ->setLcrId($lcrId)
            ->setGwName($gwName)
            ->setIp($dto->getIp())
            ->setHostname($dto->getHostname())
            ->setPort($dto->getPort())
            ->setParams($dto->getParams())
            ->setUriScheme($dto->getUriScheme())
            ->setTransport($dto->getTransport())
            ->setStrip($dto->getStrip())
            ->setPrefix($dto->getPrefix())
            ->setTag($dto->getTag())
            ->setDefunct($dto->getDefunct())
            ->setCarrierServer($fkTransformer->transform($dto->getCarrierServer()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TrunksLcrGatewayDto
    {
        return self::createDto()
            ->setLcrId(self::getLcrId())
            ->setGwName(self::getGwName())
            ->setIp(self::getIp())
            ->setHostname(self::getHostname())
            ->setPort(self::getPort())
            ->setParams(self::getParams())
            ->setUriScheme(self::getUriScheme())
            ->setTransport(self::getTransport())
            ->setStrip(self::getStrip())
            ->setPrefix(self::getPrefix())
            ->setTag(self::getTag())
            ->setDefunct(self::getDefunct())
            ->setCarrierServer(CarrierServer::entityToDto(self::getCarrierServer(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'lcr_id' => self::getLcrId(),
            'gw_name' => self::getGwName(),
            'ip' => self::getIp(),
            'hostname' => self::getHostname(),
            'port' => self::getPort(),
            'params' => self::getParams(),
            'uri_scheme' => self::getUriScheme(),
            'transport' => self::getTransport(),
            'strip' => self::getStrip(),
            'prefix' => self::getPrefix(),
            'tag' => self::getTag(),
            'defunct' => self::getDefunct(),
            'carrierServerId' => self::getCarrierServer()?->getId()
        ];
    }

    protected function setLcrId(int $lcrId): static
    {
        Assertion::greaterOrEqualThan($lcrId, 0, 'lcrId provided "%s" is not greater or equal than "%s".');

        $this->lcrId = $lcrId;

        return $this;
    }

    public function getLcrId(): int
    {
        return $this->lcrId;
    }

    protected function setGwName(string $gwName): static
    {
        Assertion::maxLength($gwName, 200, 'gwName value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->gwName = $gwName;

        return $this;
    }

    public function getGwName(): string
    {
        return $this->gwName;
    }

    protected function setIp(?string $ip = null): static
    {
        if (!is_null($ip)) {
            Assertion::maxLength($ip, 50, 'ip value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ip = $ip;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    protected function setHostname(?string $hostname = null): static
    {
        if (!is_null($hostname)) {
            Assertion::maxLength($hostname, 64, 'hostname value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->hostname = $hostname;

        return $this;
    }

    public function getHostname(): ?string
    {
        return $this->hostname;
    }

    protected function setPort(?int $port = null): static
    {
        if (!is_null($port)) {
            Assertion::greaterOrEqualThan($port, 0, 'port provided "%s" is not greater or equal than "%s".');
        }

        $this->port = $port;

        return $this;
    }

    public function getPort(): ?int
    {
        return $this->port;
    }

    protected function setParams(?string $params = null): static
    {
        if (!is_null($params)) {
            Assertion::maxLength($params, 64, 'params value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->params = $params;

        return $this;
    }

    public function getParams(): ?string
    {
        return $this->params;
    }

    protected function setUriScheme(?int $uriScheme = null): static
    {
        if (!is_null($uriScheme)) {
            Assertion::greaterOrEqualThan($uriScheme, 0, 'uriScheme provided "%s" is not greater or equal than "%s".');
        }

        $this->uriScheme = $uriScheme;

        return $this;
    }

    public function getUriScheme(): ?int
    {
        return $this->uriScheme;
    }

    protected function setTransport(?int $transport = null): static
    {
        if (!is_null($transport)) {
            Assertion::greaterOrEqualThan($transport, 0, 'transport provided "%s" is not greater or equal than "%s".');
        }

        $this->transport = $transport;

        return $this;
    }

    public function getTransport(): ?int
    {
        return $this->transport;
    }

    protected function setStrip(?bool $strip = null): static
    {
        $this->strip = $strip;

        return $this;
    }

    public function getStrip(): ?bool
    {
        return $this->strip;
    }

    protected function setPrefix(?string $prefix = null): static
    {
        if (!is_null($prefix)) {
            Assertion::maxLength($prefix, 16, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    protected function setTag(?string $tag = null): static
    {
        if (!is_null($tag)) {
            Assertion::maxLength($tag, 64, 'tag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->tag = $tag;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    protected function setDefunct(?int $defunct = null): static
    {
        if (!is_null($defunct)) {
            Assertion::greaterOrEqualThan($defunct, 0, 'defunct provided "%s" is not greater or equal than "%s".');
        }

        $this->defunct = $defunct;

        return $this;
    }

    public function getDefunct(): ?int
    {
        return $this->defunct;
    }

    public function setCarrierServer(?CarrierServerInterface $carrierServer = null): static
    {
        $this->carrierServer = $carrierServer;

        return $this;
    }

    public function getCarrierServer(): ?CarrierServerInterface
    {
        return $this->carrierServer;
    }
}
