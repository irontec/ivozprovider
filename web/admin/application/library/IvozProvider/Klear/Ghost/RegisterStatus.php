<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocation;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationDto;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\Terminal\TerminalDto;

class IvozProvider_Klear_Ghost_RegisterStatus extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * Get Register Status for Terminals
     * @param TerminalDto $model
     * @return string HTML code to display SIP register status icon
     * @throws Zend_Exception
     */
    public function getTerminalStatusIcon($model)
    {
        return $this->getLocationStatusIcon($model);
    }

    /**
     * Get Register Status for Users Terminals
     * @param UserDto $model
     * @return string HTML code to display SIP register status
     * @throws Zend_Exception
     */
    public function getUserTerminalStatusIcon($model)
    {
        if (!$model->getTerminalId()) {
            return '<span class="ui-silk inline ui-silk-error" title="No terminal assigned"></span>';
        }

        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var TerminalDto $terminal */
        $terminal = $dataGateway->find(
            Terminal::class,
            $model->getTerminalId()
        );

        return $this->getLocationStatusIcon($terminal);
    }

    /**
     * Get Register Status for Terminals
     * @param TerminalDto $model
     * @return string HTML code to display SIP register status
     * @throws Zend_Exception
     */
    public function getTerminalStatus($model)
    {
        return $this->getLocationStatus($model);
    }

    /**
     * Get Register Status for Friends
     * @param FriendDto $model
     * @return string HTML code to display SIP register status icon
     * @throws Zend_Exception
     */
    public function getFriendStatusIcon($model)
    {
        $registerStatus = $this->getDirectConnectivityStatus($model);
        if (empty($registerStatus)) {
            $registerStatus = $this->getLocationStatusIcon($model);
        }
        return $registerStatus;
    }

    /**
     * Get Register Status for Friends
     * @param FriendDto $model
     * @return string HTML code to display SIP register status
     * @throws Zend_Exception
     */
    public function getFriendStatus($model)
    {
        $registerStatus = $this->getDirectConnectivityStatus($model);
        if (empty($registerStatus)) {
            $registerStatus = $this->getLocationStatus($model);
        }
        return $registerStatus;
    }

    /**
     * Get Register Status for Residential Devices
     * @param ResidentialDeviceDto $model
     * @return string HTML code to display SIP register status icon
     * @throws Zend_Exception
     */
    public function getResidentialDeviceStatusIcon($model)
    {
        $registerStatus = $this->getDirectConnectivityStatus($model);
        if (empty($registerStatus)) {
            $registerStatus = $this->getLocationStatusIcon($model);
        }
        return $registerStatus;
    }

    /**
     * Get Register Status for Residential Devices
     * @param ResidentialDeviceDto $model
     * @return string HTML code to display SIP register status
     * @throws Zend_Exception
     */
    public function getResidentialDeviceStatus($model)
    {
        $registerStatus = $this->getDirectConnectivityStatus($model);
        if (empty($registerStatus)) {
            $registerStatus = $this->getLocationStatus($model);
        }
        return $registerStatus;
    }

    /**
     * Get Register Status for Residential Devices
     * @param RetailAccountDto $model
     * @return string HTML code to display SIP register status icon
     * @throws Zend_Exception
     */
    public function getRetailAccountStatusIcon($model)
    {
        $registerStatus = $this->getDirectConnectivityStatus($model);
        if (empty($registerStatus)) {
            $registerStatus = $this->getLocationStatusIcon($model);
        }
        return $registerStatus;
    }

    /**
     * Get Register Status for Residential Devices
     * @param RetailAccountDto $model
     * @return string HTML code to display SIP register status
     * @throws Zend_Exception
     */
    public function getRetailAccountStatus($model)
    {
        $registerStatus = $this->getDirectConnectivityStatus($model);
        if (empty($registerStatus)) {
            $registerStatus = $this->getLocationStatus($model);
        }
        return $registerStatus;
    }

    /**
     * Check if entity has direct connectivity enabled
     * @param FriendDto|ResidentialDeviceDto $model
     * @return string HTML code to display SIP register status or empty string
     */
    private function getDirectConnectivityStatus($model)
    {
        // No Dynamic Status
        if ($model->getDirectConnectivity() === 'yes') {
            return '<span class="ui-silk inline ui-silk-arrow-right" title="Direct connectivity"></span>';
        }
        return "";
    }

    /**
     * Get Register Status from UsersLocation Table
     *
     * @param TerminalDto|FriendDto|ResidentialDeviceDto $model
     * @return string HTML code to display SIP register status icon
     * @throws Zend_Exception
     */
    private function getLocationStatusIcon($model)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var DomainDto $domain */
        $domain = $dataGateway->find(
            Domain::class,
            $model->getDomainId()
        );

        $where = array(
            "UsersLocation.username = '" . $model->getName() . "'",
            "UsersLocation.domain = '" . $domain->getDomain() . "'"
        );

        /** @var UsersLocationDto $location */
        $location = $dataGateway->findOneBy(
            UsersLocation::class,
            [
                implode(' AND ', $where),
            ],
            [
                "UsersLocation.expires" => "DESC"
            ]
        );

        // Draw a green tick if found
        if (!is_null($location)) {
            return '<span class="ui-silk inline ui-silk-tick" title="Registered until ' .
                $location->getExpires()->format("Y-m-d H:i:s") . '"></span>';
        }

        // Draw a red cross if not found
        return '<span class="ui-silk inline ui-silk-exclamation" title="Not registered"></span>';
    }

    /**
     * Get Register Status from UsersLocation Table
     *
     * @param TerminalDto|FriendDto|ResidentialDeviceDto $model
     * @return string HTML code to display SIP register status
     * @throws Zend_Exception
     */
    private function getLocationStatus($model)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var DomainDto $domain */
        $domain = $dataGateway->find(
            Domain::class,
            $model->getDomainId()
        );

        $where = array(
            "UsersLocation.username = '" . $model->getName() . "'",
            "UsersLocation.domain = '" . $domain->getDomain() . "'"
        );


        /** @var UsersLocationDto[] $location */
        $locations = $dataGateway->findBy(
            UsersLocation::class,
            [
                implode(' AND ', $where),
            ],
            [
                "UsersLocation.expires" => "DESC"
            ]
        );

        if (!empty($locations)) {
            $registerStatus = '<table width="100%" >';

            foreach ($locations as $location) {
                preg_match('/sips?:([^@]+@)?(?P<domain>[^;]+)/', $location->getContact(), $matches);
                $contactSrc = $matches['domain'];

                $receivedSrc = null;
                $received = $location->getReceived();
                if ($received) {
                    preg_match('/sips?:([^@]+@)?(?P<domain>[^;]+)/', $received, $matches);
                    $receivedSrc = $matches['domain'];
                }

                $registerStatus .= sprintf(
                    '
                            <tr>
                                <td><span class="ui-silk inline ui-silk-tick" title="Registered until %s"/> %s </td>
                                <td><span class="ui-silk inline ui-silk-telephone" title="Contact Address" /> %s</td>
                                <td><span class="ui-silk inline ui-silk-world" title="Received Address" /> %s</td>
                            </tr>',
                    $location->getExpires()->format("Y-m-d H:i:s"),
                    $location->getUserAgent(),
                    $contactSrc,
                    $receivedSrc
                );
            }

            $registerStatus .= '</table>';
        } else {
            // Draw a red cross if not active registries found
            $registerStatus = '<span class="ui-silk inline ui-silk-exclamation" /> Not Registered';
        }

        return $registerStatus;
    }
}
