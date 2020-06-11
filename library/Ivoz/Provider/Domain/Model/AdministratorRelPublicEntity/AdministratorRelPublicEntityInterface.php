<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface AdministratorRelPublicEntityInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Get create
     *
     * @return boolean
     */
    public function getCreate(): bool;

    /**
     * Get read
     *
     * @return boolean
     */
    public function getRead(): bool;

    /**
     * Get update
     *
     * @return boolean
     */
    public function getUpdate(): bool;

    /**
     * Get delete
     *
     * @return boolean
     */
    public function getDelete(): bool;

    /**
     * Set administrator
     *
     * @param \Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface $administrator
     *
     * @return static
     */
    public function setAdministrator(\Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface $administrator);

    /**
     * Get administrator
     *
     * @return \Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface
     */
    public function getAdministrator();

    /**
     * Get publicEntity
     *
     * @return \Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityInterface
     */
    public function getPublicEntity();

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
