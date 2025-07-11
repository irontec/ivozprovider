<?php

namespace Service\Domain\Dashboard;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiRepository;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceRepository;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailRepository;
use Model\Dashboard\Dashboard;
use Model\Dashboard\DashboardClient;
use Model\Dashboard\DashboardResidentialDevice;

class GetResidentialInfo
{
    public function __construct(
        private ResidentialDeviceRepository $residentialDeviceRepository,
        private DdiRepository $ddiRepository,
        private VoicemailRepository $voicemailRepository
    ) {
    }

    public function execute(CompanyInterface $company, string $productName = 'Ivoz Provider'): Dashboard
    {
        $client = DashboardClient::fromCompany($company);

        $residentialDeviceNum = $this
            ->residentialDeviceRepository
            ->count([
                'company' => $company->getId()
            ]);

        $ddiNum = $this
            ->ddiRepository
            ->countByCompany(
                (int)$company->getId()
            );

        $voiceMailNum = $this
            ->voicemailRepository
            ->count([
                'company' => $company->getId()
            ]);

        $residentialDevices = $this
            ->residentialDeviceRepository
            ->findLastAddedByCompanyId(
                (int)$company->getId()
            );

        /** @var DashboardResidentialDevice[] $dashboardResidentialDevices */
        $dashboardResidentialDevices = [];
        foreach ($residentialDevices as $residentialDevice) {
            $dashboardResidentialDevices[] = DashboardResidentialDevice::fromResidentialDevice($residentialDevice);
        }

        $dashboard = new Dashboard(
            client: $client,
            residentialDeviceNum: $residentialDeviceNum,
            ddiNum: $ddiNum,
            voiceMailNum: $voiceMailNum,
            latestResidentialDevices: $dashboardResidentialDevices,
            productName: $productName
        );


        return $dashboard;
    }
}
