<?php

namespace Ivoz\Ast\Domain\Service\Voicemail;

use Ivoz\Ast\Domain\Model\Voicemail\Voicemail;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailDto;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailRepository;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Service\ResidentialDevice\ResidentialDeviceLifecycleEventHandlerInterface;

class UpdateByResidentialDevice implements ResidentialDeviceLifecycleEventHandlerInterface
{
    const POST_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var VoicemailRepository
     */
    protected $voicemailRepository;

    public function __construct(
        EntityTools $entityTools,
        VoicemailRepository $voicemailRepository
    ) {
        $this->entityTools = $entityTools;
        $this->voicemailRepository = $voicemailRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::POST_PERSIST_PRIORITY
        ];
    }

    public function execute(ResidentialDeviceInterface $residentialDevice)
    {
        /** @var Voicemail $voicemail */
        $voicemail = $this->voicemailRepository->findOneBy([
            'residentialDevice' => $residentialDevice->getId()
        ]);

        $voicemailDto = is_null($voicemail)
            ? new VoicemailDto()
            : $this->entityTools->entityToDto($voicemail);

        $company = $residentialDevice->getCompany();

        // Update/Insert voicemail data
        $voicemailDto
            ->setResidentialDeviceId($residentialDevice->getId())
            ->setContext($residentialDevice->getVoiceMailContext())
            ->setMailbox($residentialDevice->getVoiceMailUser())
            ->setTz($company->getDefaultTimezone()->getTz());

        $this->entityTools->persistDto(
            $voicemailDto,
            $voicemail
        );
    }
}
