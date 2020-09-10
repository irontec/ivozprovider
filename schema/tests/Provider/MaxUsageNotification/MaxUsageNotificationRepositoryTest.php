<?php

namespace Tests\Provider\MaxUsageNotification;

use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotificationInterface;
use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotificationRepository;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\MaxUsageNotification\MaxUsageNotification;

class MaxUsageNotificationRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_finds_by_company();
    }

    public function it_finds_by_company()
    {
        /** @var CompanyRepository $companyRepository */
        $companyRepository = $this->em
            ->getRepository(Company::class);


        /** @var MaxUsageNotificationRepository $maxUsageRepository */
        $maxUsageRepository = $this->em
            ->getRepository(MaxUsageNotification::class);

        /** @var MaxUsageNotificationInterface $balanceNotification */
        $balanceNotification = $maxUsageRepository
            ->findByCompany(
                $companyRepository->find(1)
            );

        $this->assertInstanceOf(
            MaxUsageNotification::class,
            $balanceNotification
        );
    }
}
