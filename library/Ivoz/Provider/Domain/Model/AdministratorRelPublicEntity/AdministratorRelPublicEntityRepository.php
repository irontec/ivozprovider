<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

interface AdministratorRelPublicEntityRepository extends ObjectRepository, Selectable
{
    public function setWritePermissions(AdministratorInterface $administrator): int;

    public function setReadOnlyPermissions(AdministratorInterface $administrator): int;
}
