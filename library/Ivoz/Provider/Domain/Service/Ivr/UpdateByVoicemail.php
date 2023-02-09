<?php

namespace Ivoz\Provider\Domain\Service\Ivr;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\Ivr\IvrRepository;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Service\Voicemail\VoicemailLifecycleEventHandlerInterface;

/**
 * Class UpdateByVoicemail
 */
class UpdateByVoicemail implements VoicemailLifecycleEventHandlerInterface
{
    public const PRE_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools,
        private IvrRepository $ivrRepository
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY
        ];
    }

    /**
     * @param VoicemailInterface $voicemail
     *
     * @return void
     */
    public function execute(VoicemailInterface $voicemail)
    {
        /** @var Ivr[] $ivrs */
        $ivrs = $this->ivrRepository->findByVoicemail($voicemail);
        foreach ($ivrs as $ivr) {
            $noInputVoicemail = $ivr->getNoInputVoicemail();
            $errorVoicemail = $ivr->getErrorVoicemail();

            /** @var IvrDto $ivrDto */
            $ivrDto = $this->entityTools->entityToDto($ivr);

            if ($noInputVoicemail && $noInputVoicemail->getId() === $voicemail->getId()) {
                $ivrDto
                    ->setNoInputRouteType(null)
                    ->setNoInputVoicemailId(null);

                $this->entityTools->persistDto($ivrDto, $ivr);
            }

            if ($errorVoicemail && $errorVoicemail->getId() === $voicemail->getId()) {
                $ivrDto
                    ->setErrorRouteType(null)
                    ->setErrorVoicemailId(null);

                $this->entityTools->persistDto($ivrDto, $ivr);
            }
        }
    }
}
