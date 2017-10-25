<?php

class IvozProvider_Klear_Ghost_ParsedCDRsFields extends KlearMatrix_Model_Field_Ghost_Abstract
{

    /**
     *
     * @param $model DDI
     *            model
     * @return name of target based on DDI type
     */
    public function getCallSrcSummary (\IvozProvider\Model\ParsedCDRs $model)
    {
        $content = "<p>";
        $content .=     " <b>Extension: </b>".$model->getSrc()."<br />";
        $content .=     " <b>Dialed: </b>".$model->getSrcDialed()."<br />";
        $content .=     " <b>Duration: </b>".$model->getSrcDuration()."<br />";
        $content .= "</p>";

        return $content;
    }

    public function getCallDstSummary (\IvozProvider\Model\ParsedCDRs $model)
    {
        $content = "<p>";
        $content .=     " <b>Number: </b>".$model->getDst()."</br>";
        $content .=     " <b>Src cid: </b>".$model->getDstSrcCid()."<br />";
        $content .=     " <b>Duration: </b>".$model->getDstDuration()."<br />";
        $content .= "</p><br />";

        return $content;
    }

    public function getCallTypeSummary (\IvozProvider\Model\ParsedCDRs $model)
    {
        $content = "<span title='".$model->getDesc()."'>".$model->getType()."</span>";

        return $content;
    }

    public function getSearchConditionsForCallTypeSummary($values, $searchOps, $model)
    {
        $where = "type in ('".implode("','", $values)."')";
        return $where;
    }

    public function getMeteringSummary (\IvozProvider\Model\ParsedCDRs $model)
    {
        $metered = $model->getMetered();
        if ($metered == 0) {
            return "";
        }

        $meteringDate = $model->getMeteringDate(true);
        $meteringDate->setTimezone(date_default_timezone_get());
        $content  = $meteringDate->toString();
        $content .= "<p>";
        $content .=     " <b>Pricing plan: </b>".$model->getPricingPlan()->getName();
        $content .=     " <b>Target pattern: </b>".$model->getTargetPattern()->getName();
        $content .= "</p>";
        $content .= "<p>";
        $content .=     " <b>Price: </b>".$model->getPrice()." €";
        $content .= "</p>";

        return $content;
    }

    public function getSrcAdapted (\IvozProvider\Model\ParsedCDRs $model)
    {
        return $this->stripCompanyCC($model->getSrc(), $model->getCompany()->getCountries()->getCountryCode());
    }

    public function getSrcDialedAdapted (\IvozProvider\Model\ParsedCDRs $model)
    {
        return $this->stripCompanyCC($model->getSrcDialed(), $model->getCompany()->getCountries()->getCountryCode());
    }

    public function getDstAdapted (\IvozProvider\Model\ParsedCDRs $model)
    {
        return $this->stripCompanyCC($model->getDst(), $model->getCompany()->getCountries()->getCountryCode());
    }

    public function getSmartDuration (\IvozProvider\Model\ParsedCDRs $model)
    {
        $billDuration = $model->getBillDuration();

        if (!is_null($billDuration)) {
            return $billDuration;
        }
        
        return $model->getSrcDuration();
    }

    public function stripCompanyCC ($num, $cc) {
        return preg_replace("/^$cc/", "", $num);
    }
}
