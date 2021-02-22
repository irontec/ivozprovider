<?php

namespace spec\Ivoz\Provider\Domain\Service\Company;

use Ivoz\Cgr\Infrastructure\Cgrates\Service\SetMaxUsageThresholdService;
use Ivoz\Provider\Domain\Model\Brand\Brandinterface;
use Ivoz\Provider\Domain\Service\Company\SendCgratesUpdateRequest;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionRepository;
use Ivoz\Provider\Infrastructure\Gearman\Jobs\Cgrates;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionInterface;

class SendCgratesUpdateRequestSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $tpAccountActionRepository;
    protected $setMaxUsageThresholdService;
    protected $cgratesReloadJob;


    protected $company;

    public function let(
        TpAccountActionRepository $tpAccountActionRepository,
        SetMaxUsageThresholdService $setMaxUsageThresholdService,
        Cgrates $cgratesReloadJob
    ) {
        $this->tpAccountActionRepository = $tpAccountActionRepository;
        $this->setMaxUsageThresholdService = $setMaxUsageThresholdService;
        $this->cgratesReloadJob = $cgratesReloadJob;

        $this->company = $this->getTestDouble(
            CompanyInterface::class
        );

        $this->beConstructedWith(
            $this->tpAccountActionRepository,
            $this->setMaxUsageThresholdService,
            $this->cgratesReloadJob
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(
            SendCgratesUpdateRequest::class
        );
    }

    function it_does_nothing_on_delete()
    {
        $this
            ->company
            ->hasBeenDeleted()
            ->willReturn(true)
            ->shouldBeCalled();

        $this
            ->company
            ->isNew()
            ->shouldNotBeCalled();

        $this->execute(
            $this->company
        );
    }

    function it_triggers_reload_job_if_new()
    {
        $this->prepareExecution();

        $this
            ->company
            ->isNew()
            ->willReturn(true)
            ->shouldbeCalled();

        $this
            ->cgratesReloadJob
            ->send()
            ->shouldbeCalled();

        $this->execute(
            $this->company
        );
    }

    function it_triggers_reload_job_if_billingMethod_has_changed()
    {
        $this->prepareExecution();

        $this
            ->company
            ->hasChanged('billingMethod')
            ->willReturn(true)
            ->shouldbeCalled();

        $this
            ->cgratesReloadJob
            ->send()
            ->shouldbeCalled();

        $this->execute(
            $this->company
        );
    }

    function it_set_new_max_usage_if_changed()
    {
        $this->prepareExecution();

        $this
            ->company
            ->hasChanged('maxDailyUsage')
            ->willReturn(true)
            ->shouldbeCalled();

        $this
            ->setMaxUsageThresholdService
            ->execute(
                Argument::type('string'),
                Argument::type('string'),
                Argument::type('numeric')
            )
            ->shouldBeCalled();

        $this->execute(
            $this->company
        );
    }

    private function prepareExecution()
    {
        $companyId = 1;
        $tpId = 'b1';
        $company = $this->company;

        $brand = $this->getTestDouble(
            Brandinterface::class
        );

        $this->getterProphecy(
            $brand,
            [
                'getCgrTenant' => 'b1'
            ],
            false
        );

        $this->getterProphecy(
            $company,
            [
                'hasBeenDeleted' => false,
                'isNew' => false,
                'getId' => $companyId,
                'getCgrSubject' => 'c1',
                'getBrand' => $brand,
                'getMaxDailyUsage' => 100
            ],
            false
        );

        $company
            ->hasChanged('billingMethod')
            ->willReturn(false);

        $company
            ->hasChanged('maxDailyUsage')
            ->willReturn(false);

        $tpAccountAction = $this->getTestDouble(
            TpAccountActionInterface::class
        );

        $tpAccountAction
            ->getTpid()
            ->willReturn(
                $tpId
            );

        $this
            ->tpAccountActionRepository
            ->findByCompany(
                $companyId
            )
            ->willReturn(
                $tpAccountAction
            );

        $this->fluentSetterProphecy(
            $this->cgratesReloadJob,
            [
                'setTpid' => $tpId,
                'setDisableDestinations' => Argument::any(),
            ],
            false
        );
    }
}
