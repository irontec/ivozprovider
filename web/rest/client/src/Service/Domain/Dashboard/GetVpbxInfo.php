<?php

namespace Service\Domain\Dashboard;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiRepository;
use Ivoz\Provider\Domain\Model\Extension\ExtensionRepository;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Model\Dashboard\Dashboard;
use Model\Dashboard\DashboardClient;
use Model\Dashboard\DashboardUser;

class GetVpbxInfo
{
    public function __construct(
        private UserRepository $userRepository,
        private ExtensionRepository $extensionRepository,
        private DdiRepository $ddiRepository
    ) {
    }

    public function execute(CompanyInterface $company, string $productName = 'Ivoz Provider'): Dashboard
    {
        $client = DashboardClient::fromCompany($company);

        $userNum = $this
            ->userRepository
            ->count([
                'company' => $company->getId()
            ]);

        $extensionNum = $this
            ->extensionRepository
            ->count([
                'company' => $company->getId()
            ]);

        $ddiNum = $this
            ->ddiRepository
            ->countByCompany(
                (int) $company->getId()
            );

        $latestUsers = $this
            ->userRepository
            ->findLatestAddedByCompany(
                (int) $company->getId()
            );

        /** @var DashboardUser[] $dashboardLatestUsers */
        $dashboardLatestUsers = [];
        foreach ($latestUsers as $user) {
            $dashboardLatestUsers[] = DashboardUser::fromUser($user);
        }

        $dashboard = new Dashboard(
            client: $client,
            userNum: $userNum,
            extensionNum: $extensionNum,
            ddiNum: $ddiNum,
            latestUsers: $dashboardLatestUsers,
            productName: $productName
        );

        return $dashboard;
    }
}
