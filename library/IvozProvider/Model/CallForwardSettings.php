<?php

/**
 * Application Model
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Model;
class CallForwardSettings extends Raw\CallForwardSettings
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function toArrayPortal()
    {

        $model = array();

        $model['id'] = $this->getId();
        $model['userId'] = $this->getUserId();

        $numberValue = $this->getNumberValue();
        settype($numberValue, "integer");

        $model['callTypeFilter'] = $this->getCallTypeFilter();
        $model['callForwardType'] = $this->getCallForwardType();
        $model['targetType'] = $this->getTargetType();
        $model['numberValue'] = $numberValue;
        $model['extensionId'] = $this->getExtensionId();

        if ($this->getExtensionId() == null) {
            $model['extension'] = '';
        } else {
            $model['extension'] = $this->getExtension()->getNumber();
        }

        $model['voiceMailUserId'] = $this->getVoiceMailUserId();

        if ($this->getVoiceMailUserId() == null) {
            $model['voiceMailUser'] = '';
        } else {
            $model['voiceMailUser'] = $this->getVoiceMailUser()->getFullName();
        }

        $model['noAnswerTimeout'] = $this->getNoAnswerTimeout();

        return $model;

    }

}
