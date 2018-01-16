<?php

namespace Agi\Action;

use Agi\ChannelInfo;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Locution\LocutionDTO;
use Ivoz\Provider\Domain\Model\Locution\LocutionRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class ServiceAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var ChannelInfo
     */
    protected $channelInfo;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var CompanyServiceInterface
     */
    protected  $service;

    /**
     * ServiceAction constructor.
     * @param Wrapper $agi
     * @param ChannelInfo $channelInfo
     * @param EntityManagerInterface $em
     * @param EntityPersisterInterface $entityPersister
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        EntityManagerInterface $em,
        EntityPersisterInterface $entityPersister
    )
    {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->em = $em;
        $this->entityPersister = $entityPersister;
    }

    /**
     * @param $service
     * @return $this
     */
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $service = $this->service;

        if (is_null($service)) {
            $this->agi->error("Service is not properly defined. Check configuration.");
            return;
        }

        // Some feedback for asterisk cli
        $this->agi->notice("Processing Service %s [service%d]",
                        $service->getService()->getName()->getEs(), $service->getId());

        // Process this service
        switch ($service->getService()->getIden()) {
            case 'Voicemail':
                $this->processVoiceMail();
                break;
            case 'DirectPickUp':
                $this->processDirectPickUp();
                break;
            case 'GroupPickUp':
                $this->processGroupPickUp();
                break;
            case 'RecordLocution':
                $this->processRecordLocution();
                break;
        }
    }

    /**
     *
     */
    private function processVoiceMail()
    {
        /** @var UserInterface $caller */
        $caller = $this->channelInfo->getChannelCaller();
        $company = $caller->getCompany();

        /**
         * Extract optional Voicemail Extension from dialed number
         *
         *               ServiceCode (up to 3 digits)
         *                   ┌┴┐
         *   $dialedExten = *CCCXXXXXXXX
         *                      └───┬──┘
         *                      VoicemailExtension (optional)
         */
        $dialedExten = $this->agi->getExtension();
        $serviceCodeLen = strlen($this->service->getCode());
        $vmExtension = substr($dialedExten, $serviceCodeLen + 1);

        if (!empty($vmExtension)) {
            $extension = $company->getExtension($vmExtension);

            if (empty($extension)) {
                $this->agi->error("Extension %s not found for company %s", $vmExtension, $company);
                return;
            }

            if (empty($extension->getUser())) {
                $this->agi->error("Extension %s does not route to an user.", $vmExtension);
                return;
            }

            // Checkvoicemail for exten user
            $this->agi->verbose("Checking user %s voicemail", $extension->getUser()->getName());
            $this->agi->checkVoicemail($extension->getUser()->getVoiceMail());
        } else {
            // Checkvoicemail for caller user (without requesting password)
            $this->agi->checkVoicemail($caller->getVoiceMail(), "s");
        }
    }

    protected function processDirectPickUp()
    {
        /** @var UserInterface $caller */
        $caller = $this->channelInfo->getChannelCaller();
        $company = $caller->getCompany();

        $exten = substr($this->agi->getExtension(), strlen($this->service->getCode()) + 1);
        $extension = $company->getExtension($exten);
        if (empty($extension)) {
            $this->agi->error("Extension %s not found for company %s", $exten, $company);
            return;
        }
        $capturedUser = $extension->getUser();

        if (empty($capturedUser) || $capturedUser->getId() == $caller->getId()) {
            $this->agi->verbose("Pickup without valid destination.");
            return;
        }

        // Get user terminal
        $capturedTerminal = $capturedUser->getTerminal();
        if (empty($capturedTerminal)) {
            $this->agi->verbose("%s has not associated terminal.", $capturedUser);
            return;
        }

        // Get Terminal endpoint
        $capturedEndpoint = $capturedTerminal->getSorcery();
        $this->agi->verbose("Attempting pickup %s", $capturedEndpoint);
        $result = $this->agi->pickup($capturedEndpoint);

        if ($result == "SUCCESS") {
            $this->agi->verbose("Successful pickup %s", $capturedEndpoint);
        } else {
            // Target not found here
            $this->agi->hangup(3);
        }

    }

    protected function processGroupPickUp()
    {
        // Local variables to improve readability
        $caller = $this->channelInfo->getChannelCaller();

        //check if user is in any pickupgroup
        $pickUpGroups = $caller->getPickUpGroups();
        if (empty($pickUpGroups)) {
            $this->agi->verbose("%s has no capture groups.", $caller);
            return;
        }

        $result = $this->agi->pickup();

        if ($result == "SUCCESS") {
            $this->agi->verbose("Successful pickup");
        } else {
            // Target not found here
            $this->agi->hangup(3);
        }

    }

    protected function processRecordLocution()
    {
        // Local variables to improve readability
        $service = $this->service;
        $caller = $this->channelInfo->getChannelCaller();

        /**
         * Extract locutionId from dialed number
         *
         *               ServiceCode (up to 3 digits)
         *                   ┌┴┐
         *   $dialedExten = *CCCXXXXXXXX
         *                      └───┬──┘
         *                      Locution ID
         */
        $dialedExten = $this->agi->getExtension();
        $serviceCodeLen = strlen($service->getCode());
        $locutionId = substr($dialedExten, $serviceCodeLen + 1);

        /** @var LocutionRepository $locutionRepository */
        $locutionRepository = $this->em->getRepository(Locution::class);

        /** @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $locution */
        $locution = $locutionRepository->find($locutionId);

        // Check if call can record this locution
        if ($locution->getCompany()->getId() !== $caller->getCompany()->getId()) {
            return;
        }

        // Check if the locution already has sound
        if ($locution->getOriginalFile()->getFileSize()) {
            $this->agi->playback("ivozprovider/record-existing");
        } else {
            $this->agi->playback("ivozprovider/record-new");
        }

        // Recording instructions
        $this->agi->playback("ivozprovider/record-intro");
        $originalFilename = $locution->getId() . ".wav";
        $originalFile = "/tmp/locution_record_" . $originalFilename;

        // Record file playing a beep before starting
        $this->agi->record($originalFile, ",,ky");

        // Set upload the original file of the locution
        /** @var LocutionDTO $locutionDto */
        $locutionDto = $locution->toDTO();
        $locutionDto->setOriginalFilePath($originalFile);
        $locutionDto->setOriginalFileBaseName($originalFilename);

        $this->entityPersister->persistDto($locutionDto, $locution);
    }
}
