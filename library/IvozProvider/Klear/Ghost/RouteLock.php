<?php

class IvozProvider_Klear_Ghost_RouteLock extends KlearMatrix_Model_Field_Ghost_Abstract
{
    public function getLockStatusIcon($model)
    {
        if ($model->isOpen()) {
            return '<span class="ui-silk inline ui-silk-tick" title="Opened"/>';
        } else {
            return '<span class="ui-silk inline ui-silk-stop" title="Closed"/>';
        }

    }


    public function getOpenExtension($model)
    {
        return $this->getServiceExtension($model, "OpenLock");
    }

    public function getCloseExtension($model)
    {
        return $this->getServiceExtension($model, "CloseLock");
    }

    public function getToggleExtension($model)
    {
        return $this->getServiceExtension($model, "ToggleLock");
    }

    public function getServiceExtension($model, $iden)
    {
        // Get Close Service code
        $company = $model->getCompany();
        $services = $company->getCompanyServices();

        // Get Close number for this lock
        foreach ($services as $service) {
            if ($service->getService()->getIden() === $iden) {
                return "*" . $service->getCode() . $model->getId();
            }
        }
    }
}
