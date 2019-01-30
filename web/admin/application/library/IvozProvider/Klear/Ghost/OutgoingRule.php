<?php

use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternDto;

class IvozProvider_Klear_Ghost_OutgoingRule extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     *
     * @param OutgoingDdiRuleDto $model
     * @return string Forced DDI text based on action
     * @throws Exception
     */
    public function getOutgoingRuleForcedDDI($model)
    {
        switch ($model->getDefaultAction()) {
            case 'force':
                if ($model->getForcedDdi()) {
                    return $model->getForcedDdi()
                        ? $model->getForcedDdi()->getDdiE164()
                        : '';
                } else {
                    return Klear_Model_Gettext::gettextCheck('_("Company\'s default")');
                }
            case 'keep':
            default:
                return "";
        }
    }

    /**
     *
     * @param $model OutgoingDdiRulesPatternDto
     * @return string Forced DDI text based on action
     * @throws Exception
     */
    public function getOutgoingRulePatternForcedDDI($model)
    {
        switch ($model->getAction()) {
            case 'force':
                if ($model->getForcedDDIId()) {
                    return $model->getForcedDDI()->getDDIE164();
                } else {
                    return Klear_Model_Gettext::gettextCheck('_("Company\'s default")');
                }
            case 'keep':
            default:
                return "";
        }
    }
}
