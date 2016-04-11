<?php

class Oasis_Klear_Ghost_ParsedCDRsSymary extends KlearMatrix_Model_Field_Ghost_Abstract
{

    /**
     *
     * @param $model DDI
     *            model
     * @return name of target based on DDI type
     */
    public function getCallSrcSumary (\Oasis\Model\ParsedCDRs $model)
    {
        $content = "<p>";
        $content .=     " <b>Extension: </b>".$model->getSrc()."<br />";
        $content .=     " <b>Dialed: </b>".$model->getSrcDialed()."<br />";
        $content .=     " <b>Duration: </b>".$model->getSrcDuration()."<br />";
        $content .= "</p>";

        return $content;
    }

    public function getCallDstSumary (\Oasis\Model\ParsedCDRs $model)
    {
        $content = "<p>";
        $content .=     " <b>Number: </b>".$model->getDst()."</br>";
        $content .=     " <b>Src cid: </b>".$model->getDstSrcCid()."<br />";
        $content .=     " <b>Duration: </b>".$model->getDstDuration()."<br />";
        $content .= "</p><br />";

        return $content;
    }

    public function getCallTypeSumary (\Oasis\Model\ParsedCDRs $model)
    {
        $content = "<span title='".$model->getDesc()."'>".$model->getType()."</span>";

        return $content;
    }

    public function getSearchConditionsForCallTypeSumary($values, $searchOps, $model)
    {
        $where = "type in ('".implode("','", $values)."')";
        return $where;
    }

    public function getMeteringSumary (\Oasis\Model\ParsedCDRs $model)
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
}
