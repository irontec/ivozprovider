<?php

namespace spec\Ivoz\Provider\Domain\Service\CallForwardSetting;

use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Infrastructure\Persistence\Doctrine\CallForwardSettingDoctrineRepository;
use Ivoz\Provider\Domain\Service\CallForwardSetting\CheckValidity;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckValiditySpec extends ObjectBehavior
{
    protected $callForwardSettingRepository;
    protected $entity;
    protected $user;

    function let(
        CallForwardSettingDoctrineRepository $callForwardSettingRepository,
        CallForwardSetting $entity,
        User $user
    ) {
        $this->callForwardSettingRepository = $callForwardSettingRepository;
        $this->beConstructedWith($callForwardSettingRepository);

        $this->user = $user;
        $this->entity = $entity;

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
            ->getUser()
            ->willReturn($this->user);
    }

    protected function getCallForwardTypeArgumentFilter($expectedCallForwardType)
    {
        return function ($criteria) use ($expectedCallForwardType) {
            $whereConditions = $criteria
                ->getWhereExpression()
                ->getExpressionList();

            $callForwardTypeCondition = end($whereConditions);
            $type = $callForwardTypeCondition
                ->getValue()
                ->getValue();

            return $type === $expectedCallForwardType;
        };
    }

    protected function getCriteriaArgument($expectedCallForwardType)
    {
        return Argument::that(
            $this->getCallForwardTypeArgumentFilter(
                $expectedCallForwardType
            )
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CheckValidity::class);
    }

    function it_throws_exception_on_already_existing_inconditional_call_forward()
    {
        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('inconditional')
            )
            ->willReturn(['Something']);

        $message = "There is an inconditional call forward with that call type. You can't add call forwards";
        $exception = new \Exception($message, 30000);

        $this
            ->shouldThrow($exception)
            ->during('execute', [$this->entity, false]);
    }

    function it_throws_exception_on_already_existing_busy_call_forward()
    {
        $this
            ->entity
            ->getCallForwardType()
            ->willReturn('busy');

        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('inconditional')
            )
            ->willReturn([]);

        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('busy')
            )
            ->willReturn(['Something']);

        $message = "There is already a busy call forward with that call type.";
        $exception = new \Exception($message, 30002);

        $this
            ->shouldThrow($exception)
            ->during('execute', [$this->entity, false]);
    }

    function it_throws_exception_on_already_existing_noAnswer_call_forward()
    {
        $this
            ->entity
            ->getCallForwardType()
            ->willReturn('noAnswer');

        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('inconditional')
            )
            ->willReturn([]);

        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('noAnswer')
            )
            ->willReturn(['Something']);

        $message = "There is already a noAnswer call forward with that call type.";
        $exception = new \Exception($message, 30003);

        $this
            ->shouldThrow($exception)
            ->during('execute', [$this->entity, false]);
    }

    function it_throws_exception_on_already_existing_userNotRegistered_call_forward()
    {
        $this
            ->entity
            ->getCallForwardType()
            ->willReturn('userNotRegistered');

        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('inconditional')
            )
            ->willReturn([]);

        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('noAnswer')
            )
            ->willReturn([]);

        $this
            ->callForwardSettingRepository
            ->matching(
                $this->getCriteriaArgument('userNotRegistered')
            )
            ->willReturn(['Something']);

        $message = "There is already a userNotRegistered call forward with that call type.";
        $exception = new \Exception($message, 30004);

        $this
            ->shouldThrow($exception)
            ->during('execute', [$this->entity, false]);
    }
}
