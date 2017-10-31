<?php

namespace Agi\Action;

use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
use Ivoz\Provider\Domain\Model\Locution\LocutionDTO;
use Ivoz\Provider\Domain\Model\Locution\LocutionRepository;
use Assert\Assertion;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Tests\LegacyProjectServiceContainer;


class ServiceAction extends RouterAction
{
    /**
     * @var \Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceInterface
     */
    protected  $_service;

    public function setService($service)
    {
        $this->_service = $service;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $service = $this->_service;
        Assertion::notNull(
            $service,
            "Service is not properly defined. Check configuration."
        );

        // Some feedback for asterisk cli
        $this->agi->notice("Processing Service %s [service%d]",
                        $service->getService()->getName()->getEs(), $service->getId());

        // Process this service
        switch ($service->getService()->getIden()) {
            case 'Voicemail':
                $this->_processVoiceMail();
                break;
            case 'DirectPickUp':
                $this->_processDirectPickUp();
                break;
            case 'GroupPickUp':
                $this->_processGroupPickUp();
                break;
            case 'RecordLocution':
                $this->_processRecordLocution();
                break;
        }
    }

    protected function _processVoiceMail()
    {
        // Local variables to improve readability
        $caller = $this->agi->getChannelCaller();
        $service = $this->_service;
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
        $serviceCodeLen = strlen($service->getCode());
        $vmExtension = substr($dialedExten, $serviceCodeLen + 1);

        if (!empty($vmExtension)) {
            $extension = $company->getExtension($vmExtension);

            if (empty($extension)) {
                $this->agi->error("Extension %s not found for company %s.", $vmExtension, $company->getId());
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

    protected function _processDirectPickUp()
    {
        // Local variables to improve readability
        $caller = $this->agi->getChannelCaller();
        $service = $this->_service;
        $company = $caller->getCompany();

        $exten = substr($this->agi->getExtension(), strlen($service->getCode()) + 1);
        $extension = $company->getExtension($exten);
        if (empty($extension)) {
            $this->agi->error("Extension %s not found for company %s.", $exten, $company->getId());
            return;
        }
        $capturedUser = $extension->getUser();

        if (empty($capturedUser) || $capturedUser == $caller) {
            $this->agi->verbose("Pickup without valid destination.");
            return;
        }

        // Get user terminal
        $capturedTerminal = $capturedUser->getTerminal();
        if (empty($capturedTerminal)) {
            $this->agi->verbose("User %s has not associated terminal.", $capturedUser->getId());
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

    protected function _processGroupPickUp()
    {
        // Local variables to improve readability
        $service = $this->_service;
        $caller = $this->agi->getChannelCaller();

        //check if user is in any pickupgroup
        $pickUpGroups = $caller->getPickUpGroups();
        if (empty($pickUpGroups)) {
            $this->agi->verbose("User %s (%s) has no capture groups.", $caller->getFullName(), $caller->getId());
            return;
        }

        $result = $this->agi->pickup();

        if ($result == "SUCCESS") {
            $this->agi->verbose("Successful pickup %s", $capturedTerminal);
        } else {
            // Target not found here
            $this->agi->hangup(3);
        }

    }

    protected function _processRecordLocution()
    {
        // Local variables to improve readability
        $service = $this->_service;
        $caller = $this->agi->getChannelCaller();

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

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = \Zend_Registry::get("em");

        /** @var LocutionRepository $locutionRepository */
        $locutionRepository = $em->getRepository(\Ivoz\Provider\Domain\Model\Locution\Locution::class);

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

        /** @var Container $serviceContainer */
        $serviceContainer = \Zend_Registry::get("serviceContainer");
        /** @var UpdateEntityFromDTO $locutionAssembler */

        $entityUpdater = $serviceContainer->get('Ivoz\Core\Application\Service\UpdateEntityFromDTO');
        $entityUpdater->execute($locution, $locutionDto);

        $em->flush($locution);
    }
}
