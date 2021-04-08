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

    public function getLastModified(): \DateTime;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
