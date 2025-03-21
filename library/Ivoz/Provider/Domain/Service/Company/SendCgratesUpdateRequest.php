<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Cgr\Domain\Job\RaterReloadInterface;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionRepository;
use Ivoz\Cgr\Domain\Service\CgratesReloadNotificator;
use Ivoz\Cgr\Infrastructure\Cgrates\Service\SetMaxUsageThresholdService;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class SendCgratesUpdateRequest extends CgratesReloadNotificator implements CompanyLifecycleEventHandlerInterface
{
    public function __construct(
        private TpAccountActionRepository $tpAccountActionRepository,
        private SetMaxUsageThresholdService $setMaxUsageThresholdService,
        RaterReloadInterface $cgratesReloadJob
    ) {
        parent::__construct($cgratesReloadJob);
    }

    public function execute(CompanyInterface $company): void
    {
        if ($company->hasBeenDeleted()) {
            return;
        }

        /** isNew will always return false ON_COMMIT */
        if ($company->hasChanged('id')) {
            $this->sendReloadJob($company);
            return;
        }

        $changedBillingMethod = $company->hasChanged('billingMethod');
        if ($changedBillingMethod) {
            $this->sendReloadJob($company);
            return;
        }

        $changedMaxDailyUsage = $company->hasChanged('maxDailyUsage');
        if (!$changedMaxDailyUsage) {
            return;
        }

        $this
            ->setMaxUsageThresholdService
            ->execute(
                $company->getBrand()->getCgrTenant(),
                $company->getCgrSubject(),
                $company->getMaxDailyUsage()
            );
    }

    /**
     * @return void
     */
    private function sendReloadJob(
        CompanyInterface $company
    ) {
        $tpAccountAction = $this
            ->tpAccountActionRepository
            ->findByCompany(
                (int) $company->getId()
            );

        if (!$tpAccountAction) {
            return;
        }

        $this->reload(
            $tpAccountAction->getTpid()
        );
    }
}
