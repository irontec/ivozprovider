<?php

namespace Ivoz\Kam\Domain\Model\UsersLocationAttr;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* UsersLocationAttrInterface
*/
interface UsersLocationAttrInterface extends EntityInterface
{

    public function getRuid(): string;

    public function getUsername(): string;

    public function getDomain(): ?string;

    public function getAname(): string;

    public function getAtype(): int;

    public function getAvalue(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getLastModified(): \DateTimeInterface;

    public function isInitialized(): bool;
}
