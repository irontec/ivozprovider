<?php

namespace Hints;

use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceRepository;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLock;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockRepository;
use Ivoz\Provider\Domain\Model\Service\Service;
use Ivoz\Provider\Domain\Model\Service\ServiceRepository;
use RouteHandlerAbstract;

class RouteLockHintsGenerator extends RouteHandlerAbstract
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function process(): void
    {
        /** @var RouteLockRepository $routeLockRepository */
        $routeLockRepository = $this->em->getRepository(RouteLock::class);
        $routeLocks = $routeLockRepository->findAllOrderByCompany();

        /** @var ServiceRepository $serviceRepository */
        $serviceRepository = $this->em->getRepository(Service::class);
        $toggleService = $serviceRepository->findByIden(Service::TOGGLE_LOCK);
        $toggleServiceId = $toggleService?->getId();
        if (!$toggleServiceId) {
            return;
        }

        /** @var CompanyServiceRepository $companyServiceRepository */
        $companyServiceRepository = $this->em->getRepository(CompanyService::class);

        // Initialize context data
        $currentCompanyId = null;
        $currentCompanyServiceCode = 0;

        /** @var RouteLockInterface $routeLock */
        foreach ($routeLocks as $routeLock) {
            $routeLockCompanyId = $routeLock->getCompany()->getId();
            if (!$routeLockCompanyId) {
                continue;
            }

            $routeLockId = $routeLock->getId();
            $routeLockDeviceName = $routeLock->getHintDeviceName();

            if ($currentCompanyId != $routeLockCompanyId) {
                $companyService = $companyServiceRepository
                    ->findCompanyService(
                        $routeLockCompanyId,
                        $toggleServiceId
                    );

                if (!$companyService) {
                    continue;
                }

                $currentCompanyId = $routeLockCompanyId;
                $currentCompanyServiceCode = $companyService->getCode();

                echo sprintf("\n[company%s]\n", $currentCompanyId);
            }

            echo sprintf(
                "exten => *%s%s,hint,%s\n",
                $currentCompanyServiceCode,
                $routeLockId,
                $routeLockDeviceName,
            );
        }
    }
}
