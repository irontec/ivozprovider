<?php
class Oasis_Klear_Ghost_ExtensionsTarget extends KlearMatrix_Model_Field_Ghost_Abstract {
    
    public function getUser($model) {
       return $model->getUser() ? $model->getUser()->getName() . " " . $model->getUser()->getLastname() : null;
    }

}
