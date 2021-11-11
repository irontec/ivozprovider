<?php

namespace Ivoz\Provider\Domain\Model\CompanyRelRoutingTag;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagInterface;

/**
* CompanyRelRoutingTagInterface
*/
interface CompanyRelRoutingTagInterface extends LoggableEntityInterface
{

    public function setCompany(?CompanyInterface $company = null): static;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int;

    public static function createDto(string|int|null $id = null): CompanyRelRoutingTagDto;

    /**
     * @internal use EntityTools instead
     * @param null|CompanyRelRoutingTagInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CompanyRelRoutingTagDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): CompanyRelRoutingTagDto;

    public function getCompany(): ?CompanyInterface;

    public function setRoutingTag(RoutingTagInterface $routingTag): static;

    public function getRoutingTag(): RoutingTagInterface;

    public function isInitialized(): bool;
}
