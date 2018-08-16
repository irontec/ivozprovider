<?php

namespace Tests\Provider\CallForwardSetting;

use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
USE Ivoz\Provider\Domain\Service\CallForwardSetting\CheckUniqueness;

class CallForwardSettingLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     * @expectedException \DomainException
     * @expectedExceptionCode Ivoz\Provider\Domain\Service\CallForwardSetting\CheckUniqueness::INCONDITIONAL_CALL_FORWARD_EXCEPTION
     */
    public function only_one_inconditional_callForward_is_allowed()
    {
        $cf = new CallForwardSettingDto();
        $cf->setCallTypeFilter('internal')
           ->setCallForwardType('inconditional')
            ->setTargetType('number')
           ->setUserId(1);

        $this->entityTools->persistDto($cf, null, true);
    }

    /**
     * @test
     * @expectedException \DomainException
     * @expectedExceptionCode Ivoz\Provider\Domain\Service\CallForwardSetting\CheckUniqueness::CALL_FORWARDS_WITH_THAT_TYPE_EXCEPTION
     */
    public function no_inconditional_callForward_if_any_of_that_type()
    {
        $cf = new CallForwardSettingDto();
        $cf->setCallTypeFilter('external')
            ->setCallForwardType('inconditional')
            ->setTargetType('number')
            ->setUserId(1);

        $this->entityTools->persistDto($cf, null, true);
    }

    /**
     * @test
     * @expectedException \DomainException
     * @expectedExceptionCode Ivoz\Provider\Domain\Service\CallForwardSetting\CheckUniqueness::BUSY_CALL_FORWARD_EXCEPTION
     */
    public function ensures_one_single_busy_call_forward_by_type()
    {
        $cf = new CallForwardSettingDto();
        $cf->setCallTypeFilter('external')
            ->setCallForwardType('busy')
            ->setTargetType('number')
            ->setUserId(1);

        $this->entityTools->persistDto($cf, null, true);
    }

    /**
     * @test
     * @expectedException \DomainException
     * @expectedExceptionCode Ivoz\Provider\Domain\Service\CallForwardSetting\CheckUniqueness::NO_ANSWER_CALL_FORWARD_EXCEPTION
     */
    public function ensures_one_single_noAnswer_call_forward_by_type()
    {
        $cf = new CallForwardSettingDto();
        $cf->setCallTypeFilter('external')
            ->setCallForwardType('noAnswer')
            ->setTargetType('number')
            ->setUserId(1);

        $this->entityTools->persistDto($cf, null, true);
    }

    /**
     * @test
     * @expectedException \DomainException
     * @expectedExceptionCode Ivoz\Provider\Domain\Service\CallForwardSetting\CheckUniqueness::USER_NOT_REGISTERED_CALL_FORWARD_EXCEPTION
     */
    public function ensures_one_single_userNotRegistered_call_forward_by_type()
    {
        $cf = new CallForwardSettingDto();
        $cf->setCallTypeFilter('external')
            ->setCallForwardType('userNotRegistered')
            ->setTargetType('number')
            ->setUserId(1);

        $this->entityTools->persistDto($cf, null, true);
    }
}