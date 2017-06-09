<?php

class IvozProvider_Klear_Ghost_RecordLocution extends KlearMatrix_Model_Field_Ghost_Abstract
{
    public function getRecordingExtension($model)
    {
        // Get Locution Service code
        $company = $model->getCompany();
        $services = $company->getCompanyServices();

        // Get Recording number for this locution
        foreach ($services as $service) {
            if ($service->getService()->getIden() === "RecordLocution") {
                return "*" . $service->getCode() . $model->getId();
            }
        }
    }

}
