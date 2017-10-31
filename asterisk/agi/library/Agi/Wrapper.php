<?php


/**
 *
 * AGI Wrapper for fastagi functions.
 * Controllers interacts with asterisk through this class thas wraps fastagi
 * functions.

 * @package Agi
 * @subpackage Agi_Wrapper
 */
class Agi_Wrapper
{
    protected $_fastagi = null;

    /**
     * Constructor Agi_Common
     * Se instancian también $fastagi y $_logger
     */
    public function __construct ()
    {
        if (\Zend_Registry::isRegistered("fastagi")) {
            $this->_fastagi = \Zend_Registry::get("fastagi");
        }
    }

    public function dump()
    {
        return $this->_fastagi->exec("DumpChan","");
    }

    private function getRequestData($name)
    {
        return $this->_fastagi->request[$name];
    }

    public function getUniqueId()
    {
        return $this->getRequestData('agi_uniqueid');
    }

    public function getExtension()
    {
        return $this->getRequestData('agi_extension');
    }

    public function getAgiType()
    {
        return $this->getRequestData('agi_type');
    }

    public function verbose()
    {
        // Build the message using first argument as format
        $arg_list = func_get_args();
        $fmt = array_shift($arg_list);
        $msg = vsprintf($fmt, $arg_list);
        return $this->_fastagi->verbose($msg);
    }

    public function notice()
    {
        // Build the message using first argument as format
        $arg_list = func_get_args();
        $fmt = array_shift($arg_list);
        $msg = vsprintf($fmt, $arg_list);
        return $this->_fastagi->notice($msg);
    }

    public function error()
    {
        // Build the message using first argument as format
        $arg_list = func_get_args();
        $fmt = array_shift($arg_list);
        $msg = vsprintf($fmt, $arg_list);
        return $this->_fastagi->error($msg);
    }

    public function setVariable($variable, $value)
    {
        if (is_null($value)) {
            $value = "";
        }
        return $this->_fastagi->set_variable($variable, $value);
    }

    public function getVariable($variable)
    {
        return $this->_fastagi->get_variable($variable, true);
    }

    public function redirect($context, $exten = null, $priority = '1')
    {
        // Dont use _fastagi->goto_dest here for now because it doesn't
        // handle dialplan labels
        //$this->_fastagi->goto_dest($context, $exten, $priority);

        // Np extension requested, used current one
        if (!$exten) {
            $exten = $this->getExtension();
        }

        return $this->_fastagi->Exec('Goto', "$context,$exten,$priority");
    }

    public function hangup($reason = "")
    {
        if (empty($reason)) {
            return $this->_fastagi->hangup();
        } else {
            return $this->_fastagi->Exec("Hangup", $reason);
        }
    }

    public function busy($duration = 4)
    {
        return $this->_fastagi->Exec("Busy", $duration);
    }

    public  function decline()
    {
        $this->_fastagi->hangup(21);
    }

    public function progress($file = "")
    {
        $this->_fastagi->exec("Progress", "");

        if (!empty($file))
            $this->playback($file, "noanswer");

        return $this;
    }

    public function playback($file, $options = "")
    {
        // TODO Check file exists?
        // FIXME Allow PhraseID instead of Filepath?
        //return $this->_fastagi->exec("Playback", $file);

        if (is_null($file) || empty($file)) {
            return;
        }

        if ($file instanceof \Ivoz\Provider\Domain\Model\Locution\LocutionInterface) {
            $file = $file->getLocutionPath();
        }

        if (empty($file))
            return;

        return $this->_fastagi->exec("Playback", "$file,$options");
    }

    public function pickup($interface = "")
    {
        if (!empty($interface)) {
           $this->_fastagi->exec("PickupChan", "PJSIP/$interface,p");
        } else {
            $this->_fastagi->exec("Pickup","");
        }
        return $this->getVariable("PICKUPRESULT");
    }

    public function read($locution, $timeout = 0, $maxdigits = 0)
    {
        $this->_fastagi->exec('Read', "PRESSED,$locution,$maxdigits,,,$timeout");
        if ($this->_fastagi->get_variable("READSTATUS") == "HANGUP") {
            return "HANGUP";
        }
        return $this->_fastagi->get_variable("PRESSED");
    }

    public function record($file, $options = "")
    {
        $this->_fastagi->exec("Record", $file . "," . $options);
    }

    public function getDeviceState($interface, $prefix = "PJSIP/")
    {
        return $this->getVariable("DEVICE_STATE($prefix$interface)");
    }

    public function getCallerIdName()
    {
        return $this->_fastagi->get_variable("CALLERID(name)");
    }

    public function setCallerIdName($name)
    {
        return $this->_fastagi->set_variable("CALLERID(name)", $name);
    }

    public function getCallerIdNum()
    {
        return $this->_fastagi->get_variable("CALLERID(num)");
    }

    public function setCallerIdNum($num)
    {
        return $this->_fastagi->set_variable("CALLERID(num)", $num);
    }

    public function setConnectedLine($type, $value)
    {
        return $this->_fastagi->set_variable("CONNECTEDLINE($type)", $value);
    }

    public function getConnectedLineNum($type)
    {
        return $this->_fastagi->get_variable("CONNECTEDLINE($type)");
    }

    public function setRDNIS($num)
    {
        return $this->_fastagi->set_variable("CALLERID(rdnis)", $num);
    }

    public function setRedirecting($type, $value)
    {
        return $this->_fastagi->set_variable("REDIRECTING($type)", $value);
    }

    public function getRedirecting($type)
    {
        return $this->_fastagi->get_variable("REDIRECTING($type)");
    }

    public function getConferenceInfo($num, $type)
    {
        return $this->_fastagi->get_variable("CONFBRIDGE_INFO($type,$num)");
    }

    public function setConferenceSetting($setting, $value)
    {
        return $this->_fastagi->set_variable("CONFBRIDGE($setting)", $value);
    }

    public function getConferenceSetting($setting)
    {
        return $this->_fastagi->get_variable("CONFBRIDGE($setting)");
    }

    public function voicemail($mailbox, $opts)
    {
        return $this->_fastagi->exec('VoiceMail', "$mailbox,$opts");
    }

    public function checkVoicemail($mailbox, $options = "")
    {
        return $this->_fastagi->exec('VoiceMailMain', $mailbox . ',' . $options);
    }

    public function setCallType($value)
    {
        if (!empty($this->getCallType()))
            return;

        return $this->_fastagi->set_variable("__CALL_TYPE", $value);
    }

    public function getCallType()
    {
        return $this->_fastagi->get_variable("CALL_TYPE");
    }

    public function setRedirectingContext($context)
    {
        $exten = $this->getExtension();
        return $this->_fastagi->set_variable("REDIRECTING_SEND_SUB", "$context,$exten,1");
    }

    public function getSIPHeader($header)
    {
        if ($this->getAgiType() == "Local") {
            return "";
        }

        return $this->_fastagi->get_variable("PJSIP_HEADER(read,$header)");
    }

    public function setSIPHeader($header, $value)
    {
        return $this->_fastagi->set_variable("PJSIP_HEADER(add,$header)", $value);
    }

    public function getEndpoint()
    {
        return $this->_fastagi->get_variable("CHANNEL(endpoint)");
    }

    public function getCallId()
    {
        if ($callid = $this->_fastagi->get_variable("CALL_ID"))
            return $callid;

        if ($this->getAgiType() == "Local")
            return "";

        return $this->_fastagi->get_variable("CHANNEL(pjsip,call-id)");
    }

    public function extractURI($uri, $variable)
    {
        if (preg_match("/([^<]*)(sip:([^@>;]+)@?([^>;:]+)?)/", $uri, $matches)) {
            switch ($variable) {
                case 'name':
                    return $matches[1];
                case 'uri':
                    return $matches[2];
                case 'num':
                    return $matches[3];
                case 'domain':
                    return $matches[4];
            }
        }
        return "";
    }


    public function setChannelOrigin($origin)
    {
        $this->setChannelData("ORIGIN", $origin);
    }

    public function setChannelCaller($caller)
    {
        $this->setChannelData("CALLER", $caller);
    }

    public function setChannelData($datatype, $data)
    {
        $id = $data->getId();

        if ($data instanceof \Ivoz\Provider\Domain\Model\User\UserInterface) {
            $type = "USER";
        } else if ($data instanceof \Ivoz\Provider\Domain\Model\Ddi\DdiInterface) {
            $type = "DDI";
        } else if ($data instanceof \Ivoz\Provider\Domain\Model\Friend\FriendInterface) {
            $type = "FRIEND";
        } else if ($data instanceof \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface) {
            $type = "RETAIL";
        } else if ($data instanceof \Ivoz\Provider\Domain\Model\Fax\FaxInterface) {
            $type = "FAX";
        }

        $this->setVariable("_${datatype}_TYPE", $type);
        $this->setVariable("_${datatype}_ID", $id);
    }

    public function getChannelCaller()
    {
        return $this->getChannelData("CALLER");
    }

    public function getChannelOrigin()
    {
        return $this->getChannelData("ORIGIN");
    }

    public function getChannelData($datatype)
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = \Zend_Registry::get("em");

        /** @var \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointRepository $endpointRepository */
        $endpointRepository = $em->getRepository('Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint');

        $type = $this->getVariable("${datatype}_TYPE");
        $id = $this->getVariable("${datatype}_ID");

        switch ($type) {
            case "USER":
                $repository = $em->getRepository('Ivoz\Provider\Domain\Model\User\User');
                break;
            case "DDI":
                $repository = $em->getRepository('Ivoz\Provider\Domain\Model\Ddi\Ddi');
                break;
            case "FRIEND":
                $repository = $em->getRepository('Ivoz\Provider\Domain\Model\Friend\Friend');
                break;
            case "RETAIL":
                $repository = $em->getRepository('Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount');
                break;
            case "FAX":
                $repository = $em->getRepository('Ivoz\Provider\Domain\Model\Fax\Fax');
                break;
            default:
                return null;
        }

        return $repository->find($id);
    }

}

