<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\PublicEntity\PublicEntityInterface;

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

    public function getCreate(): bool;

    public function getRead(): bool;

    public function getUpdate(): bool;

    public function getDelete(): bool;

    public function setAdministrator(AdministratorInterface $administrator): static;

    public function getAdministrator(): AdministratorInterface;

    public function getPublicEntity(): PublicEntityInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
