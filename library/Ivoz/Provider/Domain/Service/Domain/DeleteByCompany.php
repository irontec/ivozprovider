<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

/**
 * Class DeleteByCompany
 * @package Ivoz\Provider\Domain\Service\Domain
 */
class DeleteByCompany implements CompanyLifecycleEventHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * DeleteByCompany constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(
        EntityManagerInterface $em
    ) {
        $this->em = $em;
    }

    public function execute(CompanyInterface $entity, $isNew)
    {
        $domain = $entity->getDomain();

        if ($domain) {
            $this->em->remove($domain);
        }
    }
}
