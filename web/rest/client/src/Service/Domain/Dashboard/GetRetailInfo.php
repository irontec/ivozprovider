<?php

namespace Service\Domain\Dashboard;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiRepository;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountRepository;
use Model\Dashboard\Dashboard;
use Model\Dashboard\DashboardClient;
use Model\Dashboard\DashboardRetailAccount;

class GetRetailInfo
{
    public function __construct(
        private RetailAccountRepository $retailAccountRepository,
        private DdiRepository $ddiRepository
    ) {
    }

    public function execute(CompanyInterface $company): Dashboard
    {
        $client = DashboardClient::fromCompany($company);

        $retailsAccountNum = $this
            ->retailAccountRepository
            ->count([
                'company' => $company->getId()
            ]);

        $ddiNum = $this
            ->ddiRepository
            ->countByCompany(
                (int) $company->getId()
            );

        $latestRetailAccounts = $this
            ->retailAccountRepository
            ->findLatestByCompanyId(
                (int) $company->getId()
            );

        /** @var DashboardRetailAccount[] $dashboardRetailAccounts */
        $dashboardRetailAccounts = [];
        foreach ($latestRetailAccounts as $retailAccount) {
            $dashboardRetailAccounts[] = DashboardRetailAccount::fromRetailAccount($retailAccount);
        }

        $dashboard = new Dashboard(
            client: $client,
            latestRetailAccounts: $dashboardRetailAccounts,
            ddiNum: $ddiNum,
            retailsAccountNum: $retailsAccountNum
        );


        return $dashboard;
    }
}
