<?php

namespace Ivoz\Provider\Domain\Model\PublicEntity;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* PublicEntityInterface
*/
interface PublicEntityInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get iden
     *
     * @return string
     */
    public function getIden(): string;

    /**
     * Get fqdn
     *
     * @return string | null
     */
    public function getFqdn(): ?string;

    /**
     * Get platform
     *
     * @return bool
     */
    public function getPlatform(): bool;

    /**
     * Get brand
     *
     * @return bool
     */
    public function getBrand(): bool;

    /**
     * Get client
     *
     * @return bool
     */
    public function getClient(): bool;

    /**
     * Get name
     *
     * @return Name
     */
    public function getName(): Name;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
