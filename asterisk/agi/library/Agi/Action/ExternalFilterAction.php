<?php

namespace Agi\Action;

class ExternalFilterAction extends RouterAction
{
    protected $_filter;
    
    protected $_ddi;

    public function setFilter($filter)
    {
        $this->_filter = $filter;
        return $this;
    }
    
    public function setDDI($ddi)
    {
        $this->_ddi = $ddi;
        return $this;
    }

    public function processHoliday()
    {
        if (empty($this->_filter) || empty($this->_ddi)) {
            $this->agi->error("ExternalFilter is not properly defined. Check configuration.");
            return;
        }

        // Local variables
        $filter = $this->_filter;
        $ddi = $this->_ddi;
        
        // Play holiday locution
        $this->agi->playback($filter->getHolidayLocution());
        
        // Set Diversion information
        $count = $this->agi->getRedirecting('count'); 
        $this->agi->setRedirecting('count,i', ++$count);
        $this->agi->setRedirecting('from-name,i', $ddi->getCompany()->getName());
        $this->agi->setRedirecting('from-num,i', $ddi->getDDI());
        $this->agi->setRedirecting('reason', 'time_of_day');
        
        // Route to configured destination
        $this->_routeType       = $filter->getHolidayTargetType();
        $this->_routeExtension  = $filter->getHolidayExtension();
        $this->_routeExternal   = $filter->getOutOfScheduleNumberValue();
        $this->_routeVoiceMail  = $filter->getolidayVoiceMailUser();
        $this->route();
    }

    public function processOutOfSchedule()
    {
        if (empty($this->_filter) || empty($this->_ddi)) {
            $this->agi->error("ExternalFilter is not properly defined. Check configuration.");
            return;
        }
        
        // Local variables
        $filter = $this->_filter;
        $ddi = $this->_ddi;

        // Play holiday locution
        $this->agi->playback($filter->getOutOfScheduleLocution());

        // Set Diversion information
        $count = $this->agi->getRedirecting('count'); 
        $this->agi->setRedirecting('count,i', ++$count);        
        $this->agi->setRedirecting('from-name,i', $ddi->getCompany()->getName());
        $this->agi->setRedirecting('from-num,i', $ddi->getDDI());
        $this->agi->setRedirecting('reason', 'time_of_day');
        
        // Route to destination
        $this->_routeType       = $filter->getOutOfScheduleTargetType();
        $this->_routeExtension  = $filter->getOutOfScheduleExtension();
        $this->_routeExternal   = $filter->getOutOfScheduleNumberValue();
        $this->_routeVoiceMail  = $filter->getOutOfScheduleVoiceMailUser();
        $this->route();
    }

    protected function _routeToExternal()
    {
        // This call to external is paid by the Company :)
        $externalAction = new ExternalCallAction($this);
        $externalAction
            ->setCompany($this->_ddi->getCompany())
            ->setDestination($this->_routeExternal)
            ->process();
    }
}
