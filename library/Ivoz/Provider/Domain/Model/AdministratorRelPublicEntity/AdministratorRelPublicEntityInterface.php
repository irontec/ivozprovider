<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* AdministratorRelPublicEntityInterface
*/
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
     * @return bool
     */
    public function getCreate(): bool;

    /**
     * Get read
     *
     * @return bool
     */
    public function getRead(): bool;

    /**
     * Get update
     *
     * @return bool
     */
    public function getUpdate(): bool;

    /**
     * Get delete
     *
     * @return bool
     */
    public function getDelete(): bool;

    /**
     * Set administrator
     *
     * @param AdministratorInterface
     *
     * @return static
     */
    public function setAdministrator(AdministratorInterface $administrator): AdministratorRelPublicEntityInterface;

    /**
     * Get administrator
     *
     * @return AdministratorInterface
     */
    public function getAdministrator(): AdministratorInterface;

    /**
     * Get publicEntity
     *
     * @return PublicEntityInterface
     */
    public function getPublicEntity(): PublicEntityInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
