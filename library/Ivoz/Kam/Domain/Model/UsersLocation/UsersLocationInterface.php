<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersLocationInterface
*/
interface UsersLocationInterface extends EntityInterface
{

    public function getRuid(): string;

    public function getUsername(): string;

    public function getDomain(): ?string;

    public function getContact(): string;

    public function getReceived(): ?string;

    public function getPath(): ?string;

    public function getExpires(): \DateTime;

    public function getQ(): float;

    public function getCallid(): string;

    public function getCseq(): int;

    public function getLastModified(): \DateTime;

    public function getFlags(): int;

    public function getCflags(): int;

    public function getUserAgent(): string;

    public function getSocket(): ?string;

    public function getMethods(): ?int;

    public function getInstance(): ?string;

    public function getRegId(): int;

    public function getServerId(): int;

    public function getConnectionId(): int;

    public function getKeepalive(): int;

    public function getPartition(): int;

    public function isInitialized(): bool;
}
