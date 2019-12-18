<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionRepository;
use Ivoz\Cgr\Domain\Service\CgratesReloadNotificator;
use Ivoz\Core\Infrastructure\Domain\Service\Gearman\Jobs\Cgrates;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class SendCgratesReloadRequest extends CgratesReloadNotificator implements CompanyLifecycleEventHandlerInterface
{

    protected $tpAccountActionRepository;

    public function __construct(
        TpAccountActionRepository $tpAccountActionRepository,
        Cgrates $cgratesReloadJob
    ) {
        $this->tpAccountActionRepository = $tpAccountActionRepository;
        parent::__construct($cgratesReloadJob);
    }

    /**
     * @return void
     */
    public function execute(CompanyInterface $company)
    {
        $changedMaxDailyUsage = $company->hasChanged('maxDailyUsage');
        $changedBillingMethod = $company->hasChanged('billingMethod');

        if (!$changedMaxDailyUsage && !$changedBillingMethod) {
            return;
        }

        $tpAccountAction = $this
            ->tpAccountActionRepository
            ->findByCompany(
                $company->getId()
            );

        if (!$tpAccountAction) {
            return;
        }

        if ($changedMaxDailyUsage) {
            $this->reload(
                $tpAccountAction->getTpid(),
                $tpAccountAction->getAccount()
            );

            return;
        }

        $this->reload(
            $tpAccountAction->getTpid()
        );
    }
}
