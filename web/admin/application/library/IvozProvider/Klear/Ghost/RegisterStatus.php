<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocation;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocationDto;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
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
     * @param \Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationDto $model
     * @return string HTML code to display SIP register status
     * @throws Zend_Exception
     */
    public function getDdiProviderStatusIcon($model)
    {
        if (!$model->getId()) {
            return '<span class="ui-silk inline ui-silk-error" title="No ddi provider registration assigned"></span>';
        }

        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var \Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregDto $kamTrunksUacreg */
        $kamTrunksUacreg = $dataGateway->findOneBy(
            \Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacreg::class,
            ["TrunksUacreg.ddiProviderRegistration = '". $model->getId() ."'"]
        );

        if (!$kamTrunksUacreg) {
            return '<span class="ui-silk inline ui-silk-error" title="No ddi provider registration assigned"></span>';
        }

        $trunksClient = \Zend_Registry::get('container')->get(
            \Ivoz\Kam\Domain\Service\TrunksClientInterface::class
        );

        try {
            $regInfo = $trunksClient->getUacRegistrationInfo(
                $kamTrunksUacreg->getLUuid()
            );
        } catch (\Exception $e) {
            $regInfo = null;
        };

        $status = $regInfo['flags'] ?? '';

        $response = '';
        if ($status === 20) {
            $expires = new \DateTime('+' . $regInfo['diff_expires'] . ' seconds');
            $response =
                '<span class="ui-silk inline ui-silk-tick" title="Registered until ' .
                $expires->format("Y-m-d H:i:s") . '"></span>';
        } elseif (in_array($status, [24, 18], true)) {
            $response = '<span class="ui-silk inline ui-silk-error" title="In progress"></span>';
        } else {
            $response = '<span class="ui-silk inline ui-silk-exclamation" title="Not registered (status '. $status .')"></span>';
        }

        return $response;
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

    public function getOrderByUserTerminalStatus()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("empty auth object");
        }
        $currentBrandId = $auth->getIdentity()->brandId;

        /** @var \Ivoz\Core\Application\Service\DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        $sortedUserIds = $dataGateway->runNamedQuery(
            User::class,
            'getBrandUsersIdsOrderByTerminalExpireDate',
            [$currentBrandId]
        );

        $priority = 1;
        $response =  'CASE User.id ';
        foreach ($sortedUserIds as $posibleResult) {
            $response .= " WHEN '" . $posibleResult . "' THEN " . $priority++;
        }
        $response .= ' ELSE '. $priority .' END AS HIDDEN ORD';

        return $response;
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
        if ($model->getDirectConnectivity() === FriendInterface::DIRECTCONNECTIVITY_YES) {
            return '<span class="ui-silk inline ui-silk-arrow-right" title="Direct connectivity"></span>';
        } elseif ($model->getDirectConnectivity() === FriendInterface::DIRECTCONNECTIVITY_INTERVPBX) {
            return '<span class="ui-silk inline ui-silk-arrow-undo" title="Inter company connectivity"></span>';
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
                            </tr>
                            <tr height="30">
                                <td colspan="3"><span class="ui-silk inline ui-silk-lightbulb" title="Hint"/> %s</td>
                            </tr>',
                    $location->getExpires()->format("Y-m-d H:i:s"),
                    $location->getUserAgent(),
                    $contactSrc,
                    $receivedSrc,
                    $this->getRegisterHint($contactSrc, $receivedSrc)
                );
            }

            $registerStatus .= '</table>';
        } else {
            // Draw a red cross if not active registries found
            $registerStatus = '<span class="ui-silk inline ui-silk-exclamation" /> Not Registered';
        }

        return $registerStatus;
    }

    /***
     * @param $contact
     * @param $received
     * @return string
     */
    private function getRegisterHint($contact, $received) : string
    {
        $contactIsPrivate = $this->isRFC1918($contact);

        // No NAT
        if (is_null($received)) {
            if ($contactIsPrivate) {
                return "No NAT with private Contact (hint: internal routing)";
            }

            return "No NAT with public Contact (hint: SIP ALG / STUN)";
        }

        // NAT detected but no real NAT (e.g. DNS in Via header)
        if ($contact === $received) {
            return "Nonexistent NAT detected (hint: domain in Via header)";
        }

        // Behind NAT
        $receivedIsPublic = !$this->isRFC1918($received);

        if ($contactIsPrivate && $receivedIsPublic) {
            return "Regular NAT detected";
        }

        return sprintf(
            "Awkward NAT detected (%s Contact, %s Received)",
            $contactIsPrivate ?  "Private" : "Public",
            $receivedIsPublic ?  "Public" : "Private"
        );
    }

    /***
     * Check if given source in IP(:PORT) format is private
     *
     * @param $src
     * @return bool
     */
    private function isRFC1918($src) : bool
    {
        list ($ip) = explode(':', $src); // Extract address if port is given

        $privateAddresses = array (
            '10.0.0.0|10.255.255.255', // single class A network
            '172.16.0.0|172.31.255.255', // 16 contiguous class B network
            '192.168.0.0|192.168.255.255', // 256 contiguous class C network
            '169.254.0.0|169.254.255.255', // Link-local address also refered to as Automatic Private IP Addressing
            '127.0.0.0|127.255.255.255' // localhost
        );

        $longIp = ip2long($ip);
        if ($longIp != -1) {
            foreach ($privateAddresses as $privateAddress) {
                list ($start, $end) = explode('|', $privateAddress);

                if ($longIp >= ip2long($start) && $longIp <= ip2long($end)) {
                    return true;
                }
            }
        }

        return false;
    }
}
