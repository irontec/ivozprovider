<?php

namespace Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

/**
 * Class DeleteByCompany
 * @package Ivoz\Provider\Domain\Service\Domain
 */
class DeleteByCompany implements CompanyLifecycleEventHandlerInterface
{
    const POST_REMOVE_PRIORITY = 10;

    protected $entityTools;

    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_REMOVE => self::POST_REMOVE_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(CompanyInterface $company)
    {
        if ($company->getType() !== CompanyInterface::TYPE_VPBX) {
            return;
        }

        $domain = $company->getDomain();
        if (!$domain) {
            return;
        }

        $company->setDomain(null);
        $this->entityTools->remove($domain);
    }
}
