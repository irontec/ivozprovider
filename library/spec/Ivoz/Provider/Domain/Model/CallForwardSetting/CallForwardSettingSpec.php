<?php

namespace spec\Ivoz\Provider\Domain\Model\CallForwardSetting;

use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingDto;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CallForwardSettingSpec extends ObjectBehavior
{
    use HelperTrait;

    /** @var CallForwardSettingDto  */
    protected $dto;
    protected $user;
    protected $company;

    function let()
    {
        $this->dto = new CallForwardSettingDto();

        $this->user = $this->getTestDouble(
            UserInterface::class,
            true
        );

        $this->company = $this->getTestDouble(
            CompanyInterface::class,
            true
        );

        $this->prepareExecution(
            $this->dto,
            $this->user,
            $this->company
        );

        $this->beConstructedThrough(
            'fromDto',
            [$this->dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CallForwardSetting::class);
    }

    function it_throws_exception_on_non_numeric_number_values()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setNumberValue', ['abcd']);

        $this
            ->shouldThrow('\Exception')
            ->during('setNumberValue', ['123a']);
    }

    function it_accepts_numeric_number_values()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setNumberValue', ['123456']);
        $this
            ->shouldNotThrow('\Exception')
            ->during('setNumberValue', ['0123456']);
    }

    function it_restricts_retail_client_cfs_type_values()
    {

        $dto = new CallForwardSettingDto();
        $user = $this->getTestDouble(
            UserInterface::class,
            true
        );
        $company = $this->getTestDouble(
            CompanyInterface::class,
            true
        );

        $this->prepareExecution(
            $dto,
            $user,
            $company
        );

        $company
            ->isRetail()
            ->willReturn(true);

        $validTypes = [
            CallForwardSettingInterface::CALLFORWARDTYPE_USERNOTREGISTERED,
            CallForwardSettingInterface::CALLFORWARDTYPE_INCONDITIONAL,
        ];

        $invalidTypes = [
            CallForwardSettingInterface::CALLFORWARDTYPE_BUSY,
            CallForwardSettingInterface::CALLFORWARDTYPE_NOANSWER,
        ];

        foreach ($validTypes as $valid) {
            $dto->setCallForwardType($valid);

            $this
                ->shouldNotThrow('\Exception')
                ->during('updateFromDto', [
                    $dto,
                    new \spec\DtoToEntityFakeTransformer()
                ]);
        }

        foreach ($invalidTypes as $invalid) {
            $dto->setCallForwardType($invalid);

            $this
                ->shouldThrow('\Exception')
                ->during('updateFromDto', [
                    $dto,
                    new \spec\DtoToEntityFakeTransformer()
                ]);
        }
    }

    private function prepareExecution(
        $dto,
        $user,
        $company
    ) {
        $dto
            ->setCallTypeFilter('internal')
            ->setCallForwardType(
                CallForwardSettingInterface::CALLFORWARDTYPE_INCONDITIONAL
            )
            ->setTargetType('extension')
            ->setNoAnswerTimeout(10);

        $this->getterProphecy(
            $company,
            [
                'isRetail' => false
            ],
            false
        );

        $this->linkDependencies(
            $dto,
            $user,
            $company
        );
    }

    private function linkDependencies($dto, $user, $company)
    {
        $this->getterProphecy(
            $user,
            [
                'getCompany' => $company
            ],
            false
        );

        $this->hydrate(
            $dto,
            [
                'user' => $user->reveal(),
            ]
        );
    }
}
