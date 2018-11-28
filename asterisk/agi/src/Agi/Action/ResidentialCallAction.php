<?php

namespace Agi\Action;

use Agi\Wrapper;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;


class ResidentialCallAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var ResidentialDeviceInterface
     */
    protected $residentialDevice;

    /**
     * @var ResidentialStatusAction
     */
    protected $residentialStatusAction;

    /**
     * ResidentialCallAction constructor.
     * @param Wrapper $agi
     * @param ResidentialStatusAction $residentialStatusAction
     */
    public function __construct(
        Wrapper $agi,
        ResidentialStatusAction $residentialStatusAction
    )
    {
        $this->agi = $agi;
        $this->residentialStatusAction = $residentialStatusAction;
    }

    /**
     * @param ResidentialDeviceInterface|null $residentialDevice
     * @return $this
     */
    public function setResidentialDevice(ResidentialDeviceInterface $residentialDevice = null)
    {
        $this->residentialDevice = $residentialDevice;
        return $this;
    }

    public function process()
    {
        // Local variables to improve readability
        $residentialDevice = $this->residentialDevice;

        if (is_null($residentialDevice)) {
            $this->agi->error("Residential Device is not properly defined. Check configuration.");
            return;
        }

        // Get dialed number
        $number =  $this->agi->getExtension();

        // Some verbose dolan pls
        $this->agi->notice("Preparing call to %s through account %s", $number, $residentialDevice);

        // Check if user has call forwarding enabled
        $forwarded = $this->residentialStatusAction
            ->setResidentialDevice($residentialDevice)
            ->setDialStatus(ResidentialStatusAction::Forwarded)
            ->process();

        if ($forwarded) {
            return;
        }

        // Get device endpoint
        $endpointName = $residentialDevice->getSorcery();

        // Configure Dial options
        $timeout = $this->getDialTimeout();
        $options = "";

        if ($this->getResidentialStatusRequired()) {
            $options .= "g";
        }

        // Call the PSJIP endpoint
        $this->agi->setVariable("DIAL_EXT", $number);
        $this->agi->setVariable("DIAL_DST", "PJSIP/$endpointName");
        $this->agi->setVariable("__DIAL_ENDPOINT", $endpointName);
        $this->agi->setVariable("DIAL_TIMEOUT", $timeout);
        $this->agi->setVariable("DIAL_OPTS", $options);

        // Redirect to the calling dialplan context
        $this->agi->redirect('call-residential', $number);
    }

    /**
     * If Device has NoAnswer Call forward setting, return the dial timeout
     *
     * @return string
     */
    private function getDialTimeout()
    {
        $timeout = null;

        // Get active NoAnswer call forwards
        $criteria = [
            array('callForwardType', 'eq', 'noAnswer'),
            array('enabled', 'eq', '1'),
        ];

        /**
         * @var CallForwardSettingInterface[] $cfwSettings
         */
        $cfwSettings = $this->residentialDevice
            ->getCallForwardSettings(
                CriteriaHelper::fromArray($criteria)
            );

        foreach ($cfwSettings as $cfwSetting) {
            $cfwType = $cfwSetting->getCallTypeFilter();
            if ($cfwType == "both" || $cfwType == $this->agi->getCallType()) {
                $this->agi->verbose("Call Forward No answer enabled [%s]. Setting call timeout.", $cfwSetting);
                $timeout = $cfwSetting->getNoAnswerTimeout();
            }
        }

        return ($timeout)?:"";
    }

    /**
     * Determine if we must check call status after dialing the residential device
     *
     * @return boolean
     */
    private function getResidentialStatusRequired()
    {
        // internal or external call
        $callType = $this->agi->getCallType();

        // Build the criteria to look for call forward settings
        $criteria = [
            'or' => array(
                array('callForwardType', 'eq', 'noAnswer'),
                array('callForwardType', 'eq', 'busy'),
                array('callForwardType', 'eq', 'userNotRegistered'),
            ),
            'or' => array(
                array('callTypeFilter', 'eq', 'both'),
                array('callTypeFilter', 'eq', $callType),
            ),
            array('enabled', 'eq', '1')
        ];

        /** @var CallForwardSettingInterface[] $cfwSettings */
        $cfwSettings = $this->residentialDevice
            ->getCallForwardSettings(
                CriteriaHelper::fromArray($criteria)
            );

        // Return true if any of the requested Call forwards exist
        $settingNotEmpty = !empty($cfwSettings);
        return $settingNotEmpty;
    }

}
