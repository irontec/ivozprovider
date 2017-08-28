<?php

class IvozProvider_Klear_Ghost_RouteTarget extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     *
     * @param $model Anything with routeType field
     * @return route target name
     */
    public function getData ($model)
    {

        // Get DDI Route Type
        $routeType = $model->getRouteType();

        // No route type configured
        if (!$routeType) {
            return null;
        }

        // We already have the route destination
        switch ($routeType) {
            case 'number':
                return $model->getNumberValue();
            case 'friend':
                return $model->getFriendValue();
            case 'extension':
                return $model->getExtension()->getNumber();
            case 'voicemail':
                $routeType = 'voiceMailUser';
            default:
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
                break;
        }

        // Route without target
        return null;
    }
}
