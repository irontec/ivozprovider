<?php

namespace Ivoz\Kam\Domain\Model\TrunksDomainAttr;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TrunksDomainAttrInterface extends EntityInterface
{
    /**
     * Get did
     *
     * @return string
     */
    public function getDid(): string;

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get type
     *
     * @return integer
     */
    public function getType(): int;

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): string;

    /**
     * Get lastModified
     *
     * @return \DateTime
     */
    public function getLastModified(): \DateTime;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
