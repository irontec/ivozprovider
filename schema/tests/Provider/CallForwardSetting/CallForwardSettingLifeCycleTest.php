<?php

namespace Tests\Provider\CallForwardSetting;

use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Service\CallForwardSetting\CheckUniqueness;

class CallForwardSettingLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function ensures_one_single_busy_call_forward_by_type()
    {
        $this->expectException(
            \DomainException::class
        );

        $this->expectExceptionCode(
            \Ivoz\Provider\Domain\Service\CallForwardSetting\CheckUniqueness::BUSY_CALL_FORWARD_EXCEPTION
        );

        $cf = new CallForwardSettingDto();
        $cf->setCallTypeFilter('external')
            ->setCallForwardType('busy')
            ->setTargetType('number')
            ->setUserId(1);

        $this->entityTools->persistDto($cf, null, true);
    }

    /**
     * @test
     */
    public function ensures_one_single_noAnswer_call_forward_by_type()
    {
        $this->expectException(
            \DomainException::class
        );

        $this->expectExceptionCode(
            \Ivoz\Provider\Domain\Service\CallForwardSetting\CheckUniqueness::NO_ANSWER_CALL_FORWARD_EXCEPTION
        );

        $cf = new CallForwardSettingDto();
        $cf->setCallTypeFilter('external')
            ->setCallForwardType('noAnswer')
            ->setTargetType('number')
            ->setUserId(1);

        $this->entityTools->persistDto($cf, null, true);
    }

    /**
     * @test
     */
    public function ensures_one_single_userNotRegistered_call_forward_by_type()
    {
        $this->expectException(
            \DomainException::class
        );

        $this->expectExceptionCode(
            \Ivoz\Provider\Domain\Service\CallForwardSetting\CheckUniqueness::USER_NOT_REGISTERED_CALL_FORWARD_EXCEPTION
        );

        $cf = new CallForwardSettingDto();
        $cf->setCallTypeFilter('external')
            ->setCallForwardType('userNotRegistered')
            ->setTargetType('number')
            ->setUserId(1);

        $this->entityTools->persistDto($cf, null, true);
    }
}
