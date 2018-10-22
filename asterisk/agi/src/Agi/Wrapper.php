<?php

namespace Agi;

use Ivoz\Core\Application\Service\CommonStoragePathResolver;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

/**
 *
 * AGI Wrapper for fastagi functions.
 * Controllers interacts with asterisk through this class thas wraps fastagi
 * functions.

 * @package Agi
 * @subpackage Agi_Wrapper
 */
class Wrapper
{
    /**
     * @var \AGI
     */
    protected $fastagi;

    /**
     * @var CommonStoragePathResolver
     */
    protected $locutionPathResolver;

    /**
     * @var Colorizer
     */
    protected $colorizer;

    /**
     * Wrapper constructor.
     * @param \AGI $fastagi
     * @param CommonStoragePathResolver $locutionPathResolver
     * @param Colorizer $colorizer
     */
    public function __construct (
        \AGI $fastagi,
        CommonStoragePathResolver $locutionPathResolver,
        Colorizer $colorizer
    ) {
        $this->fastagi = $fastagi;
        $this->locutionPathResolver = $locutionPathResolver;
        $this->colorizer = $colorizer;
    }

    public function dump()
    {
        return $this->fastagi->exec("DumpChan","");
    }

    private function getRequestData($name)
    {
        return $this->fastagi->request[$name];
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

    public function verbose($fmt, ...$args)
    {
        $msg = $this->colorizer->parse('<blue>' . vsprintf($fmt, $args) . '</blue>');
        return $this->fastagi->verbose($msg);
    }

    public function notice($fmt, ...$args)
    {
        $msg = $this->colorizer->parse('<yellow>' . vsprintf($fmt, $args) . '</yellow>');
        return $this->fastagi->notice($msg);
    }

    public function error($fmt, ...$args)
    {
        $msg = $this->colorizer->parse('<red>' . vsprintf($fmt, $args) . '</red>');
        return $this->fastagi->error($msg);
    }

    public function setVariable($variable, $value)
    {
        if (is_null($value)) {
            $value = "";
        }
        return $this->fastagi->set_variable($variable, $value);
    }

    /**
     * Get Channel variable value
     *
     * @param $variable
     * @return string
     */
    public function getVariable($variable)
    {
        return (string) $this->fastagi->get_variable($variable, true);
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

        return $this->fastagi->Exec('Goto', "$context,$exten,$priority");
    }

    public function hangup($reason = "")
    {
        if (empty($reason)) {
            return $this->fastagi->hangup();
        } else {
            return $this->fastagi->Exec("Hangup", $reason);
        }
    }

    public function busy($duration = 4)
    {
        return $this->fastagi->Exec("Busy", $duration);
    }

    public  function decline()
    {
        $this->fastagi->hangup(21);
    }

    public function progress($file = "")
    {
        $this->fastagi->exec("Progress", "");

        if (!empty($file))
            $this->playback($file, "noanswer");

        return $this;
    }

    /**
     *
     * @param LocutionInterface|null $locution
     * @param string $options
     */
    public function playbackLocution(LocutionInterface $locution = null, $options = "")
    {
        if (empty($locution)) {
            return;
        }

        $this->locutionPathResolver->setOriginalFileName(
            $locution->getEncodedFile()->getBaseName()
        );

        $file = $this
            ->locutionPathResolver
            ->getFilePath($locution);

        if (!file_exists($file)) {
            $this->error("Locution $file not found in filesystem.");
            return;
        }

        $filename = pathinfo($file, PATHINFO_DIRNAME) . DIRECTORY_SEPARATOR . pathinfo($file, PATHINFO_FILENAME);

        $this->playback($filename, $options);

    }

    public function playback($filename = "", $options = "")
    {
        $this->fastagi->exec("Playback", "$filename,$options");
    }

    public function pickup($interface = "")
    {
        if (!empty($interface)) {
           $this->fastagi->exec("PickupChan", "PJSIP/$interface,p");
        } else {
            $this->fastagi->exec("Pickup","");
        }
        return $this->getVariable("PICKUPRESULT");
    }

    /**
     * Read DTMF digits while playing a locution
     *
     * @param LocutionInterface | null $locution
     * @param int $timeout
     * @param int $maxdigits
     *
     * @return string
     */
    public function readLocution(LocutionInterface $locution = null, $timeout = 0, $maxdigits = 0)
    {
        if (!$locution) {
            return $this->read("", $timeout, $maxdigits);
        }

        $this->locutionPathResolver->setOriginalFileName(
            $locution->getEncodedFile()->getBaseName()
        );

        $file = $this
            ->locutionPathResolver
            ->getFilePath($locution);

        if (!file_exists($file)) {
            $this->error("Locution $file not found in filesystem.");
            return $this->read("", $timeout, $maxdigits);
        }

        // Remove extension for Read application
        $filename = pathinfo($file, PATHINFO_DIRNAME) . DIRECTORY_SEPARATOR . pathinfo($file, PATHINFO_FILENAME);

        return $this->read($filename, $timeout, $maxdigits);
    }

    public function read($filename = "", $timeout = 0, $maxdigits = 0)
    {
        $this->fastagi->exec('Read', "PRESSED,$filename,$maxdigits,,,$timeout");
        if ($this->getVariable("READSTATUS") == "HANGUP") {
            return "HANGUP";
        }

        return $this->getVariable("PRESSED");
    }

    public function record($file, $options = "")
    {
        $this->fastagi->exec("Record", $file . "," . $options);
    }

    public function getDeviceState($interface, $prefix = "PJSIP/")
    {
        return $this->getVariable("DEVICE_STATE($prefix$interface)");
    }

    public function getCallerIdName()
    {
        return $this->getVariable("CALLERID(name)");
    }

    public function setCallerIdName($name)
    {
        return $this->setVariable("CALLERID(name)", $name);
    }

    public function getCallerIdNum()
    {
        return $this->getVariable("CALLERID(num)");
    }

    public function setCallerIdNum($num)
    {
        return $this->setVariable("CALLERID(num)", $num);
    }

    public function setConnectedLine($type, $value)
    {
        return $this->setVariable("CONNECTEDLINE($type)", $value);
    }

    public function getConnectedLineNum($type)
    {
        return $this->getVariable("CONNECTEDLINE($type)");
    }

    public function setRDNIS($num)
    {
        return $this->setVariable("CALLERID(rdnis)", $num);
    }

    public function setRedirecting($type, $value)
    {
        return $this->setVariable("REDIRECTING($type)", $value);
    }

    public function getRedirecting($type)
    {
        return $this->getVariable("REDIRECTING($type)");
    }

    public function getConferenceInfo($num, $type)
    {
        return $this->getVariable("CONFBRIDGE_INFO($type,$num)");
    }

    public function setConferenceSetting($setting, $value)
    {
        return $this->setVariable("CONFBRIDGE($setting)", $value);
    }

    public function getConferenceSetting($setting)
    {
        return $this->getVariable("CONFBRIDGE($setting)");
    }

    public function voicemail($mailbox, $opts = "")
    {
        return $this->fastagi->exec('VoiceMail', "$mailbox,$opts");
    }

    public function checkVoicemail($mailbox, $options = "")
    {
        return $this->fastagi->exec('VoiceMailMain', $mailbox . ',' . $options);
    }

    public function setCallType($value)
    {
        if (empty($this->getCallType())) {
            $this->setVariable("__CALL_TYPE", $value);
        }
    }

    public function getCallType()
    {
        return $this->getVariable("CALL_TYPE");
    }

    public function setRedirectingContext($context)
    {
        $exten = $this->getExtension();
        return $this->setVariable("REDIRECTING_SEND_SUB", "$context,$exten,1");
    }

    public function getSIPHeader($header)
    {
        if ($this->getAgiType() == "Local") {
            return "";
        }

        return $this->getVariable("PJSIP_HEADER(read,$header)");
    }

    public function setSIPHeader($header, $value)
    {
        return $this->setVariable("PJSIP_HEADER(add,$header)", $value);
    }

    public function getEndpoint()
    {
        return $this->getVariable("CHANNEL(endpoint)");
    }

    public function getCallId()
    {
        if ($callid = $this->getVariable("CALL_ID"))
            return $callid;

        if ($this->getAgiType() == "Local")
            return "";

        return $this->getVariable("CHANNEL(pjsip,call-id)");
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

}

