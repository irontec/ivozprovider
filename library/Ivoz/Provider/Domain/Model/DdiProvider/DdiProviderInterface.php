<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\DdiProviderAddress\DdiProviderAddressInterface;

/**
* DdiProviderInterface
*/
interface DdiProviderInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): DdiProviderDto;

    /**
     * @internal use EntityTools instead
     * @param null|DdiProviderInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?DdiProviderDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DdiProviderDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): DdiProviderDto;

    public function getDescription(): string;

    public function getName(): string;

    public function getExternallyRated(): ?bool;

    public function getBrand(): BrandInterface;

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    public function getProxyTrunk(): ?ProxyTrunkInterface;

    public function getMediaRelaySets(): ?MediaRelaySetInterface;

    public function isInitialized(): bool;

    public function addDdiProviderRegistration(DdiProviderRegistrationInterface $ddiProviderRegistration): DdiProviderInterface;

    public function removeDdiProviderRegistration(DdiProviderRegistrationInterface $ddiProviderRegistration): DdiProviderInterface;

    /**
     * @param Collection<array-key, DdiProviderRegistrationInterface> $ddiProviderRegistrations
     */
    public function replaceDdiProviderRegistrations(Collection $ddiProviderRegistrations): DdiProviderInterface;

    /**
     * @return array<array-key, DdiProviderRegistrationInterface>
     */
    public function getDdiProviderRegistrations(?Criteria $criteria = null): array;

    public function addDdiProviderAddress(DdiProviderAddressInterface $ddiProviderAddress): DdiProviderInterface;

    public function removeDdiProviderAddress(DdiProviderAddressInterface $ddiProviderAddress): DdiProviderInterface;

    /**
     * @param Collection<array-key, DdiProviderAddressInterface> $ddiProviderAddresses
     */
    public function replaceDdiProviderAddresses(Collection $ddiProviderAddresses): DdiProviderInterface;

    /**
     * @return array<array-key, DdiProviderAddressInterface>
     */
    public function getDdiProviderAddresses(?Criteria $criteria = null): array;
}
