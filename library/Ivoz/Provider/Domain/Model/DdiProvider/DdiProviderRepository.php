<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;

interface DdiProviderRepository extends ObjectRepository, Selectable
{

    public function getDdiProviderIdsByBrandAdmin(AdministratorInterface $admin): array;
}
