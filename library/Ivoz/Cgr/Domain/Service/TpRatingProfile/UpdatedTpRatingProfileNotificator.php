<?php

namespace Ivoz\Cgr\Domain\Service\TpRatingProfile;

use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfileInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\LoadTpRatingProfile;
use Ivoz\Core\Infrastructure\Domain\Service\Cgrates\RemoveTpRatingProfile;

class UpdatedTpRatingProfileNotificator implements TpRatingProfileLifecycleEventHandlerInterface
{
    const ON_COMMIT_PRIORITY = self::PRIORITY_NORMAL;

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
            self::EVENT_ON_COMMIT => self::ON_COMMIT_PRIORITY
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