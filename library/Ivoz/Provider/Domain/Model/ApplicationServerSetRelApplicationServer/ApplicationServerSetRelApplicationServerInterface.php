<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSetInterface;

/**
* ApplicationServerSetRelApplicationServerInterface
*/
interface ApplicationServerSetRelApplicationServerInterface extends LoggableEntityInterface
{
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
    public static function createDto($id = null): ApplicationServerSetRelApplicationServerDto;

    /**
     * @internal use EntityTools instead
     * @param null|ApplicationServerSetRelApplicationServerInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ApplicationServerSetRelApplicationServerDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ApplicationServerSetRelApplicationServerDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ApplicationServerSetRelApplicationServerDto;

    public function getApplicationServer(): ApplicationServerInterface;

    public function setApplicationServerSet(?ApplicationServerSetInterface $applicationServerSet = null): static;

    public function getApplicationServerSet(): ?ApplicationServerSetInterface;
}
