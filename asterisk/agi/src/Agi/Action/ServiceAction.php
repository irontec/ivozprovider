<?php

namespace Agi\Action;

use Agi\ChannelInfo;
use Agi\Wrapper;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Locution\LocutionDTO;
use Ivoz\Provider\Domain\Model\Locution\LocutionRepository;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLock;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockDto;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockRepository;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class ServiceAction
{
    /**
     * @var string
     */
    const HELLOCODE  = '*777*';

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
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var CompanyServiceInterface
     */
    protected  $service;

    /**
     * ServiceAction constructor.
     * @param Wrapper $agi
     * @param ChannelInfo $channelInfo
     * @param EntityManagerInterface $em
     * @param EntityTools $entityTools
     */
    public function __construct(
        Wrapper $agi,
        ChannelInfo $channelInfo,
        EntityManagerInterface $em,
        EntityTools $entityTools
    ) {
        $this->agi = $agi;
        $this->channelInfo = $channelInfo;
        $this->em = $em;
        $this->entityTools = $entityTools;
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
            case 'OpenLock':
                $this->processOpenLock();
                break;
            case 'CloseLock':
                $this->processCloseLock();
                break;
            case 'ToggleLock':
                $this->processToggleLock();
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
        $locutionDto = $this->entityTools->entityToDto($locution);
        $locutionDto->setOriginalFilePath($originalFile);
        $locutionDto->setOriginalFileBaseName($originalFilename);

        $this->entityTools->persistDto($locutionDto, $locution);
    }

    /**
     * @return RouteLockInterface|null
     */
    protected function getRouteLock()
    {
        // Local variables to improve readability
        $service = $this->service;
        $caller = $this->channelInfo->getChannelCaller();

        /**
         * Extract routeLockId from dialed number
         *
         *               ServiceCode (up to 3 digits)
         *                   ┌┴┐
         *   $dialedExten = *CCCXXXXXXXX
         *                      └───┬──┘
         *                      RouteLock ID
         */
        $dialedExten = $this->agi->getExtension();
        $serviceCodeLen = strlen($service->getCode());
        $routeLockId = substr($dialedExten, $serviceCodeLen + 1);

        if (!$routeLockId) {
            $this->agi->error("Incomplete lock service without id as argument.");
            return null;
        }

        /** @var RouteLockRepository $routeLockRepository */
        $routeLockRepository = $this->em->getRepository(RouteLock::class);
        /** @var RouteLockInterface $routeLock */
        $routeLock = $routeLockRepository->find($routeLockId);

        // Check if lock actually exists
        if (!$routeLock) {
            $this->agi->error("No route lock found with id %d.", $routeLockId);
            return null;
        }

        // Check if call can record this locution
        if ($routeLock->getCompany()->getId() !== $caller->getCompany()->getId()) {
            $this->agi->error("Route lock %s does not belong to %s.", $routeLock, $caller->getCompany());
            return null;
        }

        return $routeLock;
    }

    /**
     * @param RouteLockInterface $routeLock
     */
    protected function printRouteLockStatus($routeLock)
    {
        if ($routeLock->getOpen() == '1') {
            $this->agi->setConnectedLine('name', $routeLock->getName() . ' opened');
            $this->agi->setConnectedLine('num', $this->agi->getExtension());
        } else {
            $this->agi->setConnectedLine('name', $routeLock->getName() . ' closed');
            $this->agi->setConnectedLine('num', $this->agi->getExtension());
        }
        $this->agi->playback("beep");
        sleep(3);
    }

    protected function processOpenLock()
    {
        $routeLock = $this->getRouteLock();
        if ($routeLock) {
            /** @var RouteLockDto $routeLockDto */
            $routeLockDto = $this->entityTools->entityToDto($routeLock);
            $routeLockDto->setOpen(1);
            $this->entityTools->persistDto($routeLockDto, $routeLock);
            $this->printRouteLockStatus($routeLock);
        }
    }

    protected function processCloseLock()
    {
        $routeLock = $this->getRouteLock();
        if ($routeLock) {
            /** @var RouteLockDto $routeLockDto */
            $routeLockDto = $this->entityTools->entityToDto($routeLock);
            $routeLockDto->setOpen(0);
            $this->entityTools->persistDto($routeLockDto, $routeLock);
            $this->printRouteLockStatus($routeLock);
        }
    }

    protected function processToggleLock()
    {
        $routeLock = $this->getRouteLock();
        if ($routeLock) {
            /** @var RouteLockDto $routeLockDto */
            $routeLockDto = $this->entityTools->entityToDto($routeLock);
            $routeLockDto->setOpen($routeLock->isOpen() ? 0 : 1);
            $this->entityTools->persistDto($routeLockDto, $routeLock);
            $this->printRouteLockStatus($routeLock);
        }
    }

    public function processHello()
    {
        $entered = "";
        $sound = 'hello/welcome';

        do {
            $this->agi->playback($sound);
            $entered.= $digit = $this->agi->read("", 60, 1);
            $sound = "hello/$digit";
        } while (substr($entered, -3) != 777);

        $this->agi->playback("hello/hello");
    }
}
