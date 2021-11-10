<?php

namespace Ivoz\Kam\Domain\Model\TrunksCdr;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;

/**
* TrunksCdrInterface
*/
interface TrunksCdrInterface extends EntityInterface
{
    public const DIRECTION_INBOUND = 'inbound';

    public const DIRECTION_OUTBOUND = 'outbound';

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public function isOutboundCall(): bool;

    public static function createDto(string|int|null $id = null): TrunksCdrDto;

    /**
     * @internal use EntityTools instead
     * @param null|TrunksCdrInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TrunksCdrDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TrunksCdrDto;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getStartTime(): \DateTimeInterface;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getEndTime(): \DateTimeInterface;

    public function getDuration(): float;

    public function getCaller(): ?string;

    public function getCallee(): ?string;

    public function getCallid(): ?string;

    public function getCallidHash(): ?string;

    public function getXcallid(): ?string;

    public function getDiversion(): ?string;

    public function getBounced(): ?bool;

    public function getParsed(): ?bool;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getParserScheduledAt(): \DateTimeInterface;

    public function getDirection(): ?string;

    public function getCgrid(): ?string;

    public function getBrand(): ?BrandInterface;

    public function getCompany(): ?CompanyInterface;

    public function getCarrier(): ?CarrierInterface;

    public function getRetailAccount(): ?RetailAccountInterface;

    public function getResidentialDevice(): ?ResidentialDeviceInterface;

    public function getUser(): ?UserInterface;

    public function getFriend(): ?FriendInterface;

    public function getFax(): ?FaxInterface;

    public function getDdi(): ?DdiInterface;

    public function getDdiProvider(): ?DdiProviderInterface;

    public function isInitialized(): bool;
}
