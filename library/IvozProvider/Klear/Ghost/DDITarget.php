<?php

class IvozProvider_Klear_Ghost_DDITarget extends KlearMatrix_Model_Field_Ghost_Abstract
{

    /**
     *
     * @param $model DDI
     *            model
     * @return name of target based on DDI type
     */
    public function getData ($model)
    {

        // Get DDI Route Type
        $routeType = $model->getRouteType();

        // We already have the route destination
        if ($routeType == 'number') {
            return $model->getNumberValue();
        } else if ($routeType == 'friend') {
            return $model->getFriendValue();
        }

        if ($routeType) {
            // Get Target Type
            $targetGetter = 'get' . ucfirst($routeType);
            $target = $model->{$targetGetter}();

            // If Target is assigned, get its name
            if ($target) {
                if ($target instanceof \IvozProvider\Model\Raw\Users)
                    return $target->getName() . ' ' . $target->getLastname();
                else
                    return $target->getName();
            }
        }

        // DDI without route or target assigned
        return null;
    }
}
