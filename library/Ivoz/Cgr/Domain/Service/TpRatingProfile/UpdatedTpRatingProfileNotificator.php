<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;

class UpdatedTpRatingProfileNotificator implements TpRatingProfileLifecycleEventHandlerInterface
{
    /**
     * @var LoadTpRatingProfile
     */
    private $loadTpRatingProfile;

    /**
     * @var RemoveTpRatingProfile
     */
    private $removeTpRatingProfile;

    public function __construct(
        LoadTpRatingProfileInterface $loadTpRatingProfile,
        RemoveTpRatingProfileInterface $removeTpRatingProfile
    ) {
        $this->loadTpRatingProfile = $loadTpRatingProfile;
        $this->removeTpRatingProfile = $removeTpRatingProfile;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_ON_COMMIT => 10
        ];
    }

    public function execute(TpRatingProfileInterface $tpRatingProfile)
    {
        $wasRemoved = is_null($tpRatingProfile->getId());

        if ($wasRemoved) {
            $this->removeTpRatingProfile->execute($tpRatingProfile);
            return;
        }

        $this->loadTpRatingProfile->execute($tpRatingProfile);
    }
}