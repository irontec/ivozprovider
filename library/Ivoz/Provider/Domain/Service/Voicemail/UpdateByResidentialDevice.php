<?php

namespace Ivoz\Provider\Domain\Service\Voicemail;

use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailInterface;
use Ivoz\Provider\Domain\Service\ResidentialDevice\ResidentialDeviceLifecycleEventHandlerInterface;

class UpdateByResidentialDevice implements ResidentialDeviceLifecycleEventHandlerInterface
{
    public const POST_PERSIST_PRIORITY = self::PRIORITY_HIGH;

    public function __construct(
        private EntityTools $entityTools,
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    /**
     * @return void
     */
    public function execute(ResidentialDeviceInterface $residentialDevice)
    {
        $voicemail = $residentialDevice->getVoicemail();

        /** @var VoicemailDto $voicemailDto */
        $voicemailDto = $voicemail
            ? $this->entityTools->entityToDto($voicemail)
            : new VoicemailDto();

        $company = $residentialDevice->getCompany();

        $voicemailDto
            ->setCompanyId($company->getId())
            ->setResidentialDeviceId($residentialDevice->getId())
            ->setName($residentialDevice->getName());

        /** @var VoicemailInterface $voicemail */
        $voicemail = $this->entityTools->persistDto(
            $voicemailDto,
            $voicemail
        );

        $residentialDevice->setVoicemail($voicemail);
    }
}
