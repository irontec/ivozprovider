<?php

class IvozProvider_Klear_Ghost_OutgoingRule extends KlearMatrix_Model_Field_Ghost_Abstract
{
    protected $nullDDIValue = "Company's default";


    /**
     *
     * @param $model OutgoingRules
     * @return name Forced DDI text based on action
     */
    public function getOutgoingRuleForcedDDI ($model)
    {
        switch($model->getDefaultAction()) {
            case 'force':
                if ($model->getForcedDDIId()) {
                    return $model->getForcedDDI()->getDDIE164();
                } else {
                    return Klear_Model_Gettext::gettextCheck('_("' . $this->nullDDIValue . '")');
                }
            case 'keep':
                return "";
        }
    }

    /**
     *
     * @param $model OutgoingRulePatterns
     * @return name Forced DDI text based on action
     */
    public function getOutgoingRulePatternForcedDDI ($model)
    {
        switch($model->getAction()) {
            case 'force':
                if ($model->getForcedDDIId()) {
                    return $model->getForcedDDI()->getDDIE164();
                } else {
                    return Klear_Model_Gettext::gettextCheck('_("' . $this->nullDDIValue . '")');
                }
            case 'keep':
                return "";
        }
    }

}
