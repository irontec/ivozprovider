<?php

namespace Ivoz\Provider\Domain\Model\RoutingTag;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;

/**
* RoutingTagInterface
*/
interface RoutingTagInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    /**
     * @return string
     */
    public function getCgrSubject(): string;

    public static function createDto(string|int|null $id = null): RoutingTagDto;

    /**
     * @internal use EntityTools instead
     * @param null|RoutingTagInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?RoutingTagDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): RoutingTagDto;

    public function getName(): string;

    public function getTag(): string;

    public function getBrand(): BrandInterface;

    public function isInitialized(): bool;

    public function addOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingTagInterface;

    public function removeOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): RoutingTagInterface;

    public function replaceOutgoingRoutings(ArrayCollection $outgoingRoutings): RoutingTagInterface;

    public function getOutgoingRoutings(?Criteria $criteria = null): array;

    public function addRelCompany(CompanyRelRoutingTagInterface $relCompany): RoutingTagInterface;

    public function removeRelCompany(CompanyRelRoutingTagInterface $relCompany): RoutingTagInterface;

    public function replaceRelCompanies(ArrayCollection $relCompanies): RoutingTagInterface;

    public function getRelCompanies(?Criteria $criteria = null): array;
}
