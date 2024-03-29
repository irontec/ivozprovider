<?php

namespace spec\Ivoz\Provider\Domain\Service\CallForwardSetting;

use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Infrastructure\Persistence\Doctrine\CallForwardSettingDoctrineRepository;
use Ivoz\Provider\Domain\Service\CallForwardSetting\CheckUniqueness;
use Doctrine\Common\Collections\ArrayCollection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class CheckUniquenessSpec extends ObjectBehavior
{
    use HelperTrait;

    protected $callForwardSettingRepository;
    protected $entity;
    protected $user;

    function let(
        CallForwardSettingDoctrineRepository $callForwardSettingRepository,
        CallForwardSetting $entity
    ) {
        $this->callForwardSettingRepository = $callForwardSettingRepository;
        $this->entity = $entity;
        $this->beConstructedWith(
            $callForwardSettingRepository
        );
    }

    protected function prepareExecution()
    {
        $user = $this->getInstance(
            User::class
        );

        $this
            ->entity
            ->getCallTypeFilter()
            ->willReturn('Something');

        $this
            ->entity
            ->getId()
            ->willReturn(1);

        $this
            ->entity
            ->getEnabled()
            ->willReturn(1);

        $this
            ->entity
            ->getUser()
            ->willReturn($user);

        $this
            ->entity
            ->getDdi()
            ->willReturn(null);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CheckUniqueness::class);
    }

    function it_doesnt_run_checks_on_disabled_call_forward(CallForwardSetting $entity)
    {
        $entity
            ->getEnabled()
            ->willReturn(0);

        $entity
            ->getCallTypeFilter()
            ->shouldNotBeCalled();

        $this
            ->shouldNotThrow(\DomainException::class)
            ->during('execute', [$entity, false]);
    }

    function it_throws_exception_on_already_existing_busy_call_forward()
    {
        $this->prepareExecution();

        $this
            ->entity
            ->getCallForwardType()
            ->willReturn('busy');

        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('inconditional')
            )
            ->willReturn(new ArrayCollection());

        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('busy')
            )
            ->willReturn(new ArrayCollection(['Something']));

        $message = "There is already a busy call forward with that call type.";
        $exception = new \DomainException($message, 30002);

        $this
            ->shouldThrow($exception)
            ->during('execute', [$this->entity, false]);
    }

    function it_throws_exception_on_already_existing_noAnswer_call_forward()
    {
        $this->prepareExecution();

        $this
            ->entity
            ->getCallForwardType()
            ->willReturn('noAnswer');

        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('inconditional')
            )
            ->willReturn(new ArrayCollection());

        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('noAnswer')
            )
            ->willReturn(new ArrayCollection(['Something']));

        $message = "There is already a noAnswer call forward with that call type.";
        $exception = new \DomainException($message, 30003);

        $this
            ->shouldThrow($exception)
            ->during('execute', [$this->entity, false]);
    }

    function it_throws_exception_on_already_existing_userNotRegistered_call_forward()
    {
        $this->prepareExecution();

        $this
            ->entity
            ->getCallForwardType()
            ->willReturn('userNotRegistered');

        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('inconditional')
            )
            ->willReturn(new ArrayCollection());

        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('noAnswer')
            )
            ->willReturn(new ArrayCollection());

        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('userNotRegistered')
            )
            ->willReturn(new ArrayCollection(['Something']));

        $message = "There is already a userNotRegistered call forward with that call type.";
        $exception = new \DomainException($message, 30004);

        $this
            ->shouldThrow($exception)
            ->during('execute', [$this->entity, false]);
    }

    function it_throws_exception_on_already_existing_inconditional_ddi_specific_call_forward()
    {
        $this->prepareExecution();

        $ddi = $this->getInstance(
            Ddi::class
        );

        $this->getterProphecy(
            $this->entity,
            [
                'getCallForwardType' => 'inconditional',
                'getDdi' => $ddi,
            ],
            true
        );

        $criteria = $this->getCriteriaArgument(
            'inconditional',
            $ddi
        );

        $this
            ->callForwardSettingRepository
            ->matching(
                $criteria
            )
            ->willReturn(new ArrayCollection(['Something']));

        $message = "There is already a inconditional call forward with that call type.";
        $exception = new \DomainException($message, 30001);

        $this
            ->shouldThrow($exception)
            ->during('execute', [$this->entity, false]);
    }

    ////////////////////////////////////////////////////////
    ///
    ////////////////////////////////////////////////////////

    protected function getCallForwardTypeArgumentFilter($expectedCallForwardType, $ddi = null)
    {
        return function ($criteria) use ($expectedCallForwardType, $ddi) {
            $whereConditions = $criteria
                ->getWhereExpression()
                ->getExpressionList();

            $callForwardTypePosition = count($whereConditions) - 1;
            if ($ddi) {
                $callForwardTypePosition--;
            }

            $callForwardTypeCondition = $whereConditions[$callForwardTypePosition];
            $type = $callForwardTypeCondition
                ->getValue()
                ->getValue();

            $match = $type === $expectedCallForwardType;
            if (!$match) {
                return false;
            }

            if (!$ddi) {
                return true;
            }

            $ddiCondition = end($whereConditions);
            $type = $ddiCondition
                ->getValue()
                ->getValue();

            return $type === $ddi;
        };
    }

    protected function getCriteriaArgument($expectedCallForwardType, $ddi = null)
    {
        return Argument::that(
            $this->getCallForwardTypeArgumentFilter(
                $expectedCallForwardType,
                $ddi
            )
        );
    }
}
