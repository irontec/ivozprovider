<?php

namespace Ivoz\Ast\Domain\Model\VoicemailMessage;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;

/**
* VoicemailMessageInterface
*/
interface VoicemailMessageInterface extends LoggableEntityInterface
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

    public static function createDto(string|int|null $id = null): VoicemailMessageDto;

    /**
     * @internal use EntityTools instead
     * @param null|VoicemailMessageInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?VoicemailMessageDto;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param VoicemailMessageDto $dto
     */
    public static function fromDto(DataTransferObjectInterface $dto, ForeignKeyTransformerInterface $fkTransformer): static;

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): VoicemailMessageDto;

    public function getDir(): string;

    public function getMsgnum(): int;

    public function getContext(): ?string;

    public function getMacrocontext(): ?string;

    public function getCallerid(): ?string;

    public function getOrigtime(): int;

    public function getDuration(): int;

    public function getRecording(): ?string;

    public function getFlag(): ?string;

    public function getCategory(): ?string;

    public function getMailboxuser(): string;

    public function getMailboxcontext(): string;

    public function getMsgId(): ?string;

    public function getParsed(): bool;

    public function isInitialized(): bool;
}
