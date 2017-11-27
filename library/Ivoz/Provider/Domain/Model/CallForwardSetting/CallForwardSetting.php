<?php

namespace Ivoz\Provider\Domain\Model\CallForwardSetting;
use Assert\Assertion;

/**
 * CallForwardSetting
 */
class CallForwardSetting extends CallForwardSettingAbstract implements CallForwardSettingInterface
{
    use CallForwardSettingTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function setNumberValue($numberValue = null)
    {
        if (!empty($numberValue)) {
            Assertion::regex($numberValue, '/^[0-9]+$/');
        }
        return parent::setNumberValue($numberValue);
    }

    public function toArrayPortal()
    {
        /**
         * @var CallAcl $this
         */
        $response = array();

        $response['id'] = $this->getId();
        $response['userId'] = $this->getUser()->getId();

        $numberValue = $this->getNumberValue();
        settype($numberValue, "integer");

        $response['callTypeFilter'] = $this->getCallTypeFilter();
        $response['callForwardType'] = $this->getCallForwardType();
        $response['targetType'] = $this->getTargetType();
        $response['numberValue'] = $numberValue;
        $response['extensionId'] = $this->getExtension()->getId();

        $response['extensionId'] = null;
        $response['extension'] = '';
        $extension = $this->getExtension();

        if (!is_null($extension)) {
            $response['extensionId'] = $extension->getId();
            $response['extension'] = $extension->getNumber();
        }

        $voiceMailUser = $this->getVoiceMailUser();
        $response['voiceMailUserId'] = $voiceMailUser
            ? $voiceMailUser->getId()
            : null;
        $response['voiceMailUser'] = $voiceMailUser
            ? $this->getVoiceMailUser()->getFullName()
            : '';
        $response['noAnswerTimeout'] = $this->getNoAnswerTimeout();

        return $response;
    }

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164()
    {
        return
            $this->getNumberCountry()->getCountryCode() .
            $this->getNumberValue();
    }
}

