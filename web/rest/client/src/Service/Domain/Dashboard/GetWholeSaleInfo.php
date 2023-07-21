<?php

namespace Service\Domain\Dashboard;

use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCallRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Model\Dashboard\Dashboard;
use Model\Dashboard\DashboardBillableCall;
use Model\Dashboard\DashboardClient;

class GetWholeSaleInfo
{
    public function __construct(
        private BillableCallRepository $billableCallRepository
    ) {
    }

    public function execute(CompanyInterface $company): Dashboard
    {
        $client = DashboardClient::fromCompany($company);

        /** @var BillableCall[] $latestBillableCalls */
        $latestBillableCalls = $this->billableCallRepository
            ->findInitialFourByCompanyId(
                (int) $company->getId()
            );

        /** @var DashboardBillableCall[] $dashboardBillableCalls */
        $dashboardBillableCalls = [];
        foreach ($latestBillableCalls as $billableCall) {
            $dashboardBillableCalls[] = DashboardBillableCall::fromBillableCall($billableCall);
        }

        return new Dashboard(
            client: $client,
            latestBillableCalls: $dashboardBillableCalls
        );
    }
}
