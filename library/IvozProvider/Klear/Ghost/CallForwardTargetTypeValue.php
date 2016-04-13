<?php

class IvozProvider_Klear_Ghost_CallForwardTargetTypeValue extends KlearMatrix_Model_Field_Ghost_Abstract
{

    /**
     *
     * @param $model DDI
     *            model
     * @return name of target based on DDI type
     */
    public function getValue ($model)
    {
        switch($model->getTargetType()) {
            case "number":
                return $model->getNumberValue();
                break;

            case "extension":
                $extension = $model->getExtension();
                if ($extension) {
                    return $extension->getNumber();
                }
                break;

            case "voicemail":
                $user = $model->getVoiceMailUser();
                if ($user) {
                    return $user->getName() . ' ' . $user->getLastname();
                }
                break;
        }
        
        return null;
    }
}
