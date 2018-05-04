<?php

namespace spec\Ivoz\Cgr\Domain\Service\TpAccountAction;

use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountActionInterface;
use Ivoz\Cgr\Domain\Service\TpAccountAction\LoadTpAccountActionInterface;
use Ivoz\Cgr\Domain\Service\TpAccountAction\RemoveTpAccountActionInterface;
use Ivoz\Cgr\Domain\Service\TpAccountAction\UpdatedTpAccountActionNotificator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdatedTpAccountActionNotificatorSpec extends ObjectBehavior
{
    /**
     * @var LoadTpAccountActionInterface
     */
    protected $loadTpAccountAction;

    /**
     * @var
     */
    protected $removeTpAccountAction;

    function let(
        LoadTpAccountActionInterface $loadTpAccountAction,
        RemoveTpAccountActionInterface $removeTpAccountAction
    ) {
        $this->loadTpAccountAction = $loadTpAccountAction;
        $this->removeTpAccountAction = $removeTpAccountAction;

        $this->beConstructedWith($loadTpAccountAction, $removeTpAccountAction);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(
            UpdatedTpAccountActionNotificator::class
        );
    }

    function it_calls_remove_account_on_removed_tp_account(
        TpAccountActionInterface $entity
    ) {
        $entity
            ->getId()
            ->willReturn(null);

        $this
            ->removeTpAccountAction
            ->execute($entity)
            ->shouldBeCalled();

        $this
            ->execute($entity, false);
    }

    function it_calls_set_account_on_created_or_updated_tp_account(
        TpAccountActionInterface $entity
    ) {
        $entity
            ->getId()
            ->willReturn(1);

        $this
            ->loadTpAccountAction
            ->execute($entity)
            ->shouldBeCalled();

        $this
            ->execute($entity, false);
    }
}
