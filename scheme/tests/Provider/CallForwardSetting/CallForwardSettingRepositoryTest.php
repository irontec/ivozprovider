<?php

namespace Tests\Provider\CallForwardSetting;

use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting;

class CallForwardSettingRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function it_counts_by_userId()
    {
        /** @var CallForwardSettingRepository $callForwardSettingRepository */
        $callForwardSettingRepository = $this->em
            ->getRepository(CallForwardSetting::class);

        /** @var array $ids */
        $ids = $callForwardSettingRepository
            ->countByUserId(1);

        $this->assertInternalType(
            'int',
            $ids
        );
    }

    /**
     * @test
     */
    public function it_finds_by_user()
    {
        /** @var CallForwardSettingRepository $callForwardSettingRepository */
        $userRepository = $this->em
            ->getRepository(User::class);

        /** @var CallForwardSettingRepository $callForwardSettingRepository */
        $callForwardSettingRepository = $this->em
            ->getRepository(CallForwardSetting::class);

        /** @var CallForwardSettingInterface[] $callForwardSettings */
        $callForwardSettings = $callForwardSettingRepository
            ->findAndJoinByUser(
                $userRepository->find(1)
            );

        $this->assertInternalType(
            'array',
            $callForwardSettings
        );

        $this->assertInstanceOf(
            CallForwardSettingInterface::class,
            $callForwardSettings[0]
        );
    }
}