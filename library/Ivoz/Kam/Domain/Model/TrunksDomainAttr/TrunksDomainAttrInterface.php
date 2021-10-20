<?php

namespace Ivoz\Kam\Domain\Model\TrunksDomainAttr;

use Ivoz\Core\Domain\Model\EntityInterface;

/**
* TrunksDomainAttrInterface
*/
interface TrunksDomainAttrInterface extends EntityInterface
{

    public function getDid(): string;

    public function getName(): string;

    public function getType(): int;

    public function getValue(): string;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getLastModified(): \DateTimeInterface;

    public function isInitialized(): bool;
}
