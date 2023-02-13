<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;

/**
* CarrierServerInterface
*/
interface CarrierServerInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * {@inheritDoc}
     */
    public function setIp(?string $ip = null): static;

    public function getName(): string;

    public static function createDto(string|int|null $id = null): CarrierServerDto;

    /**
     * @internal use EntityTools instead
     * @param null|CarrierServerInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CarrierServerDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CarrierServerDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CarrierServerDto;

    public function getIp(): ?string;

    public function getHostname(): ?string;

    public function getPort(): ?int;

    public function getUriScheme(): ?int;

    public function getTransport(): ?int;

    public function getSendPAI(): ?bool;

    public function getSendRPID(): ?bool;

    public function getAuthNeeded(): string;

    public function getAuthUser(): ?string;

    public function getAuthPassword(): ?string;

    public function getSipProxy(): ?string;

    public function getOutboundProxy(): ?string;

    public function getFromUser(): ?string;

    public function getFromDomain(): ?string;

    public function setCarrier(CarrierInterface $carrier): static;

    public function getCarrier(): CarrierInterface;

    public function getBrand(): BrandInterface;

    public function setLcrGateway(TrunksLcrGatewayInterface $lcrGateway): static;

    public function getLcrGateway(): ?TrunksLcrGatewayInterface;
}
