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
        $dataGateway = \Zend_Registry::get('data_gateway');
        switch($model->getTargetType()) {
            case 'number':
                return $model->getNumberValue();
                break;

            case 'extension':
                $extension = null;
                $extensionId = $model->getExtensionId();

                if ($extensionId) {
                    $extension = $dataGateway->find(
                        \Ivoz\Provider\Domain\Model\Extension\Extension::class,
                        $extensionId
                    );
                }

                if ($extension) {
                    return $extension->getNumber();
                }
                break;

            case 'voicemail':

                $user = null;
                $userId = $model->getVoiceMailUserId();
                if ($userId) {

                    $user = $dataGateway->find(
                        \Ivoz\Provider\Domain\Model\User\User::class,
                        $userId
                    );
                }
                if ($user) {
                    return $user->getName() . ' ' . $user->getLastname();
                }
                break;
        }
        
        return null;
    }
}
