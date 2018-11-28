<?php

namespace Ivoz\Provider\Domain\Service\Ivr;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\Ivr\IvrRepository;
use Ivoz\Provider\Domain\Service\User\UserLifecycleEventHandlerInterface;

/**
 * Class UpdateByUser
 */
class UpdateByUser implements UserLifecycleEventHandlerInterface
{
    const PRE_REMOVE_PRIORITY = 10;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var IvrRepository
     */
    protected $ivrRepository;

    public function __construct(
        EntityTools $entityTools,
        IvrRepository $ivrRepository
    ) {
        $this->entityTools = $entityTools;
        $this->ivrRepository = $ivrRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY
        ];
    }

    /**
     * @param UserInterface $user
     */
    public function execute(UserInterface $user)
    {
        /** @var Ivr[] $ivrs */
        $ivrs = $this->ivrRepository->findByUser($user);
        foreach ($ivrs as $ivr) {
            $noInputUser = $ivr->getNoInputVoiceMailUser();
            $errorUser = $ivr->getErrorVoiceMailUser();

            /** @var IvrDto $ivrDto */
            $ivrDto = $this->entityTools->entityToDto($ivr);

            if ($noInputUser && $noInputUser->getId() === $user->getId()) {
                $ivrDto
                    ->setNoInputRouteType(null)
                    ->setNoInputVoiceMailUserId(null);

                $this->entityTools->persistDto($ivrDto, $ivr);
            }

            if ($errorUser && $errorUser->getId() === $user->getId()) {
                $ivrDto
                    ->setErrorRouteType(null)
                    ->setErrorVoiceMailUserId(null);

                $this->entityTools->persistDto($ivrDto, $ivr);
            }
        }
    }
}
