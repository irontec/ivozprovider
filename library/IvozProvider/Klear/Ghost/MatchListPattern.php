<?php

class IvozProvider_Klear_Ghost_MatchListPattern extends KlearMatrix_Model_Field_Ghost_Abstract
{

    /**
     *
     * @param $model MatchListPattern model
     * @return match value based on pattern type
     */
    public function getMatchValue($model)
    {
        switch($model->getType()) {
            case 'number':
                return $model->getNumberE164('+');
            case 'regexp':
                return $model->getRegExp();
            default:
                return '';
        }
    }
}
