<?php

class IvozProvider_Klear_Ghost_TargetGroupPatterns extends KlearMatrix_Model_Field_Ghost_Abstract
{

    /**
     *
     * @param $model DDI
     *            model
     * @return name of target based on DDI type
     */
    public function getData ($model)
    {

        $patterns = $model->getTargetPatterns();
        $patternCount = count($patterns);
        if ($patternCount > 10) {
            return sprintf("-- %d %s -- ",
            $patternCount, _('Destination patterns'));
        } else {
            $patternTexts = array();
            foreach ($patterns as $pattern) {
                $patternTexts[] =  sprintf("%s %s (%s)",
                                $pattern->getName(),
                                $pattern->getDescription(),
                                $pattern->getRegExp());
            }
            return join(', ', $patternTexts);
        }
    }
}
