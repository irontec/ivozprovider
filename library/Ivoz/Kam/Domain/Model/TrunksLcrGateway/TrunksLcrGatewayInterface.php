<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrGateway;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;

/**
* TrunksLcrGatewayInterface
*/
interface TrunksLcrGatewayInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): TrunksLcrGatewayDto;

    /**
     * @internal use EntityTools instead
     * @param null|TrunksLcrGatewayInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TrunksLcrGatewayDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TrunksLcrGatewayDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TrunksLcrGatewayDto;

    public function getLcrId(): int;

    public function getGwName(): string;

    public function getIp(): ?string;

    public function getHostname(): ?string;

    public function getPort(): ?int;

    public function getParams(): ?string;

    public function getUriScheme(): ?int;

    public function getTransport(): ?int;

    public function getStrip(): ?bool;

    public function getPrefix(): ?string;

    public function getTag(): ?string;

    public function getDefunct(): ?int;

    public function setCarrierServer(?CarrierServerInterface $carrierServer = null): static;

    public function getCarrierServer(): ?CarrierServerInterface;
}
