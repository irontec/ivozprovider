<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\MatchList\MatchList;
use Ivoz\Provider\Domain\Model\MatchList\MatchListDto;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternDto;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface;

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
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        switch ($model->getDefaultAction()) {
            case OutgoingDdiRulesPatternInterface::ACTION_FORCE:
                if (is_null($model->getForcedDdiId())) {
                    return Klear_Model_Gettext::gettextCheck('_("Company\'s default")');
                }

                /** @var DdiDto $ddiDto */
                $ddiDto = $dataGateway->find(
                    Ddi::class,
                    $model->getForcedDdiId()
                );

                return $ddiDto->getDdie164();
            case OutgoingDdiRulesPatternInterface::ACTION_KEEP:
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
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        switch ($model->getAction()) {
            case OutgoingDdiRulesPatternInterface::ACTION_FORCE:
                if (is_null($model->getForcedDdiId())) {
                    return Klear_Model_Gettext::gettextCheck('_("Company\'s default")');
                }

                /** @var DdiDto $ddiDto */
                $ddiDto = $dataGateway->find(
                    Ddi::class,
                    $model->getForcedDdiId()
                );

                return $ddiDto->getDdie164();
            case OutgoingDdiRulesPatternInterface::ACTION_KEEP:
            default:
                return "";
        }
    }

    /**
     *
     * @param $model OutgoingDdiRulesPatternDto
     * @return string for MatchList or Prefix based on pattern type
     * @throws Exception
     */
    public function getPatternRule($model)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        $type = $model->getType();

        if ($type == OutgoingDdiRulesPatternInterface::TYPE_PREFIX) {
            return $model->getPrefix();
        }

        if ($type == OutgoingDdiRulesPatternInterface::TYPE_DESTINATION) {
            /**@var MatchListDto $matchListDto */
            $matchListDto = $dataGateway->find(
                MatchList::class,
                $model->getMatchListId()
            );

            return $matchListDto->getName();
        }

        return "";
    }
}
