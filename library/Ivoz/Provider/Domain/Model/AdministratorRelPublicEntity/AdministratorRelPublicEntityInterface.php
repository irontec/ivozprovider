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
    public function getCreate();

    /**
     * Get read
     *
     * @return boolean
     */
    public function getRead();

    /**
     * Get update
     *
     * @return boolean
     */
    public function getUpdate();

    /**
     * Get delete
     *
     * @return boolean
     */
    public function getDelete();

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
}
