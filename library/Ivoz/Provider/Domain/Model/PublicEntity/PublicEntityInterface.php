<?php

namespace Ivoz\Provider\Domain\Model\PublicEntity;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function getFqdn();

    /**
     * Get platform
     *
     * @return boolean
     */
    public function getPlatform(): bool;

    /**
     * Get brand
     *
     * @return boolean
     */
    public function getBrand(): bool;

    /**
     * Get client
     *
     * @return boolean
     */
    public function getClient(): bool;

    /**
     * Get name
     *
     * @return \Ivoz\Provider\Domain\Model\PublicEntity\Name
     */
    public function getName();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
