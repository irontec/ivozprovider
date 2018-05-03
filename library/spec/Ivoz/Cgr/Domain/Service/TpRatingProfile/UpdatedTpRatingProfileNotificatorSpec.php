<?php

namespace spec\Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Ivoz\Cgr\Domain\Service\TpRatingProfile\LoadTpRatingProfileInterface;
use Ivoz\Cgr\Domain\Service\TpRatingProfile\RemoveTpRatingProfileInterface;
use Ivoz\Cgr\Domain\Service\TpRatingProfile\UpdatedTpRatingProfileNotificator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdatedTpRatingProfileNotificatorSpec extends ObjectBehavior
{
    /**
     * @var LoadTpRatingProfileInterface
     */
    private $loadTpRatingProfile;

    /**
     * @var RemoveTpRatingProfileInterface
     */
    private $removeTpRatingProfile;

    function let(
        LoadTpRatingProfileInterface $loadTpRatingProfile,
        RemoveTpRatingProfileInterface $removeTpRatingProfile
    ) {
        $this->loadTpRatingProfile = $loadTpRatingProfile;
        $this->removeTpRatingProfile = $removeTpRatingProfile;

        $this->beConstructedWith(
            $loadTpRatingProfile,
            $removeTpRatingProfile
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdatedTpRatingProfileNotificator::class);
    }

    function it_calls_remove_rating_profile_on_removed_tp_rating_profile(
        TpRatingProfileInterface $entity
    ) {
        $entity
            ->getId()
            ->willReturn(null);

        $this
            ->removeTpRatingProfile
            ->execute($entity)
            ->shouldBeCalled();

        $this
            ->execute($entity, false);
    }

    function it_calls_set_rating_profile_on_created_or_updated_tp_rating_profile(
        TpRatingProfileInterface $entity
    ) {
        $entity
            ->getId()
            ->willReturn(1);

        $this
            ->loadTpRatingProfile
            ->execute($entity)
            ->shouldBeCalled();

        $this
            ->execute($entity, false);
    }
}
