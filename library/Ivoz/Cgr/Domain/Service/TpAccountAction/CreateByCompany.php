<?php

namespace Ivoz\Cgr\Domain\Service\TpAccountAction;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountAction;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyDTO;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

class CreateByCompany implements CompanyLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * UpdateByDestinationTpAccountAction constructor.
     * @param EntityPersisterInterface $entityPersister
     */
    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 20
        ];
    }

    public function execute(CompanyInterface $company)
    {
        $isNew = $company->isNew();
        if (!$isNew) {
            return;
        }

        $brand = $company->getBrand();

        $accountActionDto = TpAccountAction::createDTO();

        // Fill all rating plan fields
        $accountActionDto
            ->setTpid($brand->getCgrTenant())
            ->setCompanyId($company->getId())
            ->setTenant($brand->getCgrTenant())
            ->setAccount($company->getCgrSubject());

        $this->entityPersister->persistDto($accountActionDto, null);
    }
}
