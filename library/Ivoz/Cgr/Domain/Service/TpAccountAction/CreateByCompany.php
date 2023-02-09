<?php

namespace Ivoz\Cgr\Domain\Service\TpAccountAction;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountAction;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionDto;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionRepository;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Service\Company\CompanyLifecycleEventHandlerInterface;

class CreateByCompany implements CompanyLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityPersisterInterface $entityPersister,
        private TpAccountActionRepository $tpAccountActionRepository,
        private EntityTools $entityTools
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 20
        ];
    }

    public function execute(CompanyInterface $company): void
    {
        $isNew = $company->isNew();

        if ($isNew) {
            $brand = $company->getBrand();
            $accountActionDto = TpAccountAction::createDTO();

            // Fill all rating plan fields
            $accountActionDto
                ->setTpid($brand->getCgrTenant())
                ->setCompanyId($company->getId())
                ->setTenant($brand->getCgrTenant())
                ->setActionTriggersTag($company->getCgrSubject())
                ->setAccount($company->getCgrSubject());
        } else {
            $accountAction = $this->tpAccountActionRepository
                ->findByCompany(
                    (int) $company->getId()
                );

            /** @var TpAccountActionDto  $accountActionDto */
            $accountActionDto = $this->entityTools->entityToDto(
                $accountAction
            );
        }

        $allowNegative = $company->getBillingMethod() === CompanyInterface::BILLINGMETHOD_POSTPAID;

        $accountActionDto->setAllowNegative($allowNegative);

        $this->entityPersister->persistDto(
            $accountActionDto,
            null
        );
    }
}
