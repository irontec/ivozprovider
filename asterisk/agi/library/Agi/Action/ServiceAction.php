<?php

namespace Agi\Action;

class ServiceAction extends RouterAction
{

    protected  $_service;
    
    public function setService($service)
    {
        $this->_service = $service;
        return $this;
    }
    
    public function process()
    {
        if (empty($this->_service) || empty($this->_user)) {
             $this->agi->error("Service is not properly defined. Check configuration.");
            return;
        }
        // Local variables to improve readability
        $service = $this->_service;
        
        // Process this service
        switch ($service->getName()) {
            case 'Voicemail':
                $this->_processVoiceMail();
                break;
            case 'DirectPickUp':
                $this->_processDirectPickUp();
                break;
            case 'GroupPickUp':
                $this->_processGroupPickUp();
                break;
        }
    }

    protected function _processVoiceMail()
    {
        // Local variables to improve readability
        $user = $this->_user;
        
        // Checkvoicemail for this user
        $this->agi->checkVoicemail($user->getVoiceMail());
    }
    
    protected function _processDirectPickUp()
    {
        // Local variables to improve readability
        $user = $this->_user;
        $company = $user->getCompany();
        
        $exten = substr($this->agi->getExtension(), 4);
        $extension = $company->getExtension($exten);
        if (empty($extension)) {
            $this->agi->error("Extension %s not found for company %s.", $exten, $company->getId());
            return;
        }
        $capturedUser = $extension->getUser();
        
        if (empty($capturedUser) || $capturedUser == $user) {
            $this->agi->verbose("Pickup without valid destination.");
            return;
        }
        
        //check if user is in any pickupgroup
        $pickUpGroups = $user->getPickUpGroups();
        if (empty($pickUpGroups)) {
            $this->agi->verbose("User %s (%s) has no capture groups.", $user->getFullName(), $user->getId());
            return;
        }
        
        $isCapturable = false;
        foreach ($pickUpGroups as $pickUpGroup) {
            $isCapturable = $pickUpGroup->isPickUpable($capturedUser);
            if ($isCapturable) {
                break;
            }
        }
        $capturedUserId = $capturedUser->getId();
        
        
        if (! $isCapturable) {
            $this->agi->verbose("User %s can not be pickuped.", $capturedUserId);
            return;
        }
        $interface = $capturedUser->getUserTerminalInterface();
        if (empty($interface)) {
            $this->agi->verbose("User %s has not associated terminal.", $capturedUserId);
            return;
        }
        
        $capturedTerminal = $capturedUser->getUserTerminalInterface();
        $this->agi->verbose("Attempting pickup %s", $capturedTerminal);
        $result = $this->agi->pickup($interface);
        
        if ($result == "SUCCESS") {
            $this->agi->verbose("Successful pickup %s", $capturedTerminal);
        }
     
    }
    
    protected function _processGroupPickUp()
    {
        // Local variables to improve readability
        $service = $this->_service;
        $user = $this->_user;
        
        //check if user is in any pickupgroup
        $pickUpGroups = $user->getPickUpGroups();
        if (empty($pickUpGroups)) {
            $this->agi->verbose("User %s (%s) has no capture groups.", $user->getFullName(), $user->getId());
            return;
        }
        
        //find for each pickUpGroup all users to pickup
        foreach ($pickUpGroups as $pickUpGroup) {
            $groupPickUpRelUsers = $pickUpGroup->getPickUpRelUsers();
            foreach ($groupPickUpRelUsers as $groupPickUpRelUser) {
                $capturedUser = $groupPickUpRelUser->getUser();
                if ($capturedUser == $user || empty($capturedUser)) {
                    continue;
                }
                $interface = $capturedUser->getUserTerminalInterface();
                if (empty($interface)) {
                    continue;
                }
                $capturedTerminal = $capturedUser->getUserTerminalInterface();
                $this->agi->verbose("Attempting pickup %s", $capturedTerminal);
                $result = $this->agi->pickup($interface);
                if ($result == "SUCCESS") {
                    $this->agi->verbose("Successful pickup %s", $capturedTerminal);
                    return;
                }
            }
        }
    }
    
}