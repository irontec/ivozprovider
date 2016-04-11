<?php

class Oasis_Klear_Ghost_IVRCommonTarget extends KlearMatrix_Model_Field_Ghost_Abstract
{

    /**
     *
     * @param $model IVRCommon
     *            model
     * @return name of target based on no answer type
     */
    public function getTimeoutData ($model)
    {
        return $this->getData($model, 'Timeout');
    }

    /**
     *
     * @param $model IVRCommon
     *            model
     * @return name of target based on error type
     */
    public function getErrorData ($model)
    {
        return $this->getData($model, 'Error');
    }

    public function getData ($model, $prefix)
    {

        // Build getters
        $typeGetter = 'get' . $prefix . 'TargetType';
        $numberGetter = 'get' . $prefix . 'NumberValue';
        $extensionGetter = 'get' . $prefix . 'Extension';
        $voicemailGetter = 'get' . $prefix . 'VoiceMailUser';

        // Get No answer handler type
        $naTargetType = $model->{$typeGetter}();
        switch ($naTargetType) {
            case 'number':
                return $model->{$numberGetter}();
            case 'extension':
                $extension = $model->{$extensionGetter}();
                if ($extension) {
                    return $extension->getNumber();
                }
                break;
            case 'voicemail':
                $voicemail = $model->{$voicemailGetter}();
                if ($voicemail) {
                    return $voicemail->getName() . ' ' .
                             $voicemail->getLastName();
                }
                break;
        }
        // No noanswer handler assigned
        return null;
    }
}
