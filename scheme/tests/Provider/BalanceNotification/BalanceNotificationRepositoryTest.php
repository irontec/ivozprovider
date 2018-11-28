<?php

namespace Tests\Provider\BalanceNotification;

use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationInterface;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotificationRepository;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotification;

class BalanceNotificationRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function it_finds_broken_thresholds_by_company()
    {
        /** @var CompanyRepository $repository */
        $repository = $this->em
            ->getRepository(Company::class);

        /** @var BalanceNotificationRepository $balanceNotificationRepository */
        $balanceNotificationRepository = $this->em
            ->getRepository(BalanceNotification::class);

        /** @var BalanceNotificationInterface $balanceNotifications */
        $balanceNotifications = $balanceNotificationRepository
            ->findBrokenThresholdsByCompany(
                $repository->find(1),
                10,
                0
            );

        $this->assertInternalType(
            'array',
            $balanceNotifications
        );

        $this->assertInstanceOf(
            BalanceNotification::class,
            $balanceNotifications[0]
        );
    }

    /**
     * @test
     */
    public function it_finds_broken_thresholds_by_carrier()
    {
        /** @var CarrierRepository $carrierRepository */
        $carrierRepository = $this->em
            ->getRepository(Carrier::class);

        /** @var BalanceNotificationRepository $balanceNotificationRepository */
        $balanceNotificationRepository = $this->em
            ->getRepository(BalanceNotification::class);

        /** @var BalanceNotificationInterface $balanceNotifications */
        $balanceNotifications = $balanceNotificationRepository
            ->findBrokenThresholdsByCarrier(
                $carrierRepository->find(1),
                10,
                0
            );

        $this->assertInternalType(
            'array',
            $balanceNotifications
        );
    }
}