<?php

namespace spec\Ivoz\Provider\Domain\Model\CallForwardSetting;

use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingDto;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use PhpSpec\ObjectBehavior;
use spec\DtoToEntityFakeTransformer;
use spec\HelperTrait;

class CallForwardSettingSpec extends ObjectBehavior
{
    use HelperTrait;

    /** @var CallForwardSettingDto  */
    protected $dto;
    protected $user;
    protected $retailAccount;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let()
    {
        $this->dto = new CallForwardSettingDto();

        $this->user = $this->getTestDouble(
            UserInterface::class,
            true
        );

        $this->retailAccount = $this->getTestDouble(
            RetailAccountInterface::class,
            true
        );

        $this->transformer = new DtoToEntityFakeTransformer();
        $this->prepareExecution(
            $this->dto,
            $this->retailAccount
        );

        $this->beConstructedThrough(
            'fromDto',
            [$this->dto, $this->transformer]
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

        $this->prepareExecution(
            $dto,
            $this->retailAccount
        );

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
                    $this->transformer
                ]);
        }

        foreach ($invalidTypes as $invalid) {
            $dto->setCallForwardType($invalid);

            $this
                ->shouldThrow('\Exception')
                ->during('updateFromDto', [
                    $dto,
                    $this->transformer
                ]);
        }
    }

    private function prepareExecution(
        CallForwardSettingDto $dto,
        $retailAccount
    ) {
        $retailAccountDto = new RetailAccountDto();

        $dto
            ->setCallTypeFilter('internal')
            ->setCallForwardType(
                CallForwardSettingInterface::CALLFORWARDTYPE_INCONDITIONAL
            )
            ->setTargetType('extension')
            ->setNoAnswerTimeout(10)
            ->setRetailAccount($retailAccountDto);

        $this->transformer->appendFixedTransforms([
            [$retailAccountDto, $retailAccount->reveal()]
        ]);
    }
}
