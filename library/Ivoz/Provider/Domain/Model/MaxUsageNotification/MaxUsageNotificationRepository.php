<?php

namespace Ivoz\Provider\Domain\Model\MaxUsageNotification;

use Doctrine\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

interface MaxUsageNotificationRepository extends ObjectRepository, Selectable
{
    /**
     * @return CompanyInterface | null
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function findByCompany(CompanyInterface $company);
}
