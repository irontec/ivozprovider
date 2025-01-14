<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSet;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServerInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
* ApplicationServerSetInterface
*/
interface ApplicationServerSetInterface extends LoggableEntityInterface
{
    public const DISTRIBUTEMETHOD_RR = 'rr';

    public const DISTRIBUTEMETHOD_HASH = 'hash';

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array;

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): ?int;

    /**
     * @param int | null $id
     */
    public static function createDto($id = null): ApplicationServerSetDto;

    /**
     * @internal use EntityTools instead
     * @param null|ApplicationServerSetInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ApplicationServerSetDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ApplicationServerSetDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ApplicationServerSetDto;

    public function getName(): string;

    public function getDistributeMethod(): string;

    public function getDescription(): ?string;

    public function addRelApplicationServer(ApplicationServerSetRelApplicationServerInterface $relApplicationServer): ApplicationServerSetInterface;

    public function removeRelApplicationServer(ApplicationServerSetRelApplicationServerInterface $relApplicationServer): ApplicationServerSetInterface;

    /**
     * @param Collection<array-key, ApplicationServerSetRelApplicationServerInterface> $relApplicationServers
     */
    public function replaceRelApplicationServers(Collection $relApplicationServers): ApplicationServerSetInterface;

    /**
     * @return array<array-key, ApplicationServerSetRelApplicationServerInterface>
     */
    public function getRelApplicationServers(?Criteria $criteria = null): array;
}
