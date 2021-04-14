<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Cgr\Domain\Job\RaterReloadInterface;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionRepository;
use Ivoz\Cgr\Domain\Service\CgratesReloadNotificator;
use Ivoz\Cgr\Infrastructure\Cgrates\Service\SetMaxUsageThresholdService;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class SendCgratesUpdateRequest extends CgratesReloadNotificator implements CompanyLifecycleEventHandlerInterface
{
    protected $tpAccountActionRepository;
    protected $setMaxUsageThresholdService;

    public function __construct(
        TpAccountActionRepository $tpAccountActionRepository,
        SetMaxUsageThresholdService $setMaxUsageThresholdService,
        RaterReloadInterface $cgratesReloadJob
    ) {
        $this->tpAccountActionRepository = $tpAccountActionRepository;
        $this->setMaxUsageThresholdService = $setMaxUsageThresholdService;
        parent::__construct($cgratesReloadJob);
    }

    /**
     * @return void
     */
    public function execute(CompanyInterface $company)
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

    private function sendReloadJob(
        CompanyInterface $company
    ) {
        $tpAccountAction = $this
            ->tpAccountActionRepository
            ->findByCompany(
                $company->getId()
            );

        if (!$tpAccountAction) {
            return;
        }

        $this->reload(
            $tpAccountAction->getTpid()
        );
    }
}
