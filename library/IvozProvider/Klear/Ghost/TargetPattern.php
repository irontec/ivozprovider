<?php

use \Ivoz\Provider\Domain\Model\PricingPlansRelTargetPattern\PricingPlansRelTargetPatternDTO;

class IvozProvider_Klear_Ghost_TargetPattern extends KlearMatrix_Model_Field_Ghost_Abstract {

    public function getTargetPattern($model)
    {
        if (!$model instanceof PricingPlansRelTargetPatternDTO) {
            Throw new \Exception('model must be an instance of PricingPlansRelTargetPatternDTO');
        }

        if ($model->getTargetPatternId()) {
            $dataGateway = \Zend_Registry::get('data_gateway');
            $pattern = $dataGateway->find(
                'Ivoz\\Provider\\Domain\Model\\TargetPattern\\TargetPattern',
                $model->getTargetPatternId()
            );
        }

        if (isset($pattern)) {

            $klearBootstrap = Zend_Controller_Front::getInstance()
                ->getParam("bootstrap")
                ->getResource('modules')
                ->offsetGet('klear');
            $siteLanguage = $klearBootstrap
                ->getOption('siteConfig')
                ->getLang();
            $currentLanguage = $siteLanguage->getLanguage();

//            Zend_Locale::getEnvironment($currentLanguage)
            $nameGetter = 'getName' . ucfirst($currentLanguage);
            return $pattern->{$nameGetter}().' ('.$pattern->getRegExp().')';
        }

        return '';
    }

    public function getOrderBy($model) {
        # En esta función también se recibe el $model

        # Devolvemos el valor generado para el ORDER BY
        return "FIELD(campo,".implode(',',valoresOrdenados).")";
    }

    public function getSearchConditionsForItem($values, $searchOps, $model) {

        if (!$model instanceof PricingPlansRelTargetPatternDTO) {
            Throw new \Exception('model must be an instance of PricingPlansRelTargetPatternDTO');
        }

        $conditions = array();
        $condition = array();

        foreach ($values as $term) {
            if (is_numeric($term)) {
                $condition[] = "regExp LIKE '%".$term."%'";
            } elseif (substr($term, 0, 1) == '(') {
                $term = str_replace("(","",$term);
                $condition[] = "regExp LIKE '".$term."%'";
            } else {
                $condition[] = "name.en LIKE '%".str_replace(' ','%',$term)."%'";
                $condition[] = "name.es LIKE '%".str_replace(' ','%',$term)."%'";
            }

            $conditions[] = '('.implode(' OR ',$condition).')';
        }

        $dataGateway = \Zend_Registry::get('data_gateway');
        $targetPatterns = $dataGateway->findBy('Core\\Model\\TargetPattern\\TargetPattern', $conditions);

        $targetPatternsIds = array();

        foreach ($targetPatterns as $targetPattern) {
            $targetPatternsIds[] = $targetPattern->getId();
        }

        if (count($targetPatternsIds) > 0) {
            $where = 'targetPatternId IN ('.implode(',',$targetPatternsIds).')';
            return $where;
        }

        return false;
    }

    protected function _filterAutocompletePrincingPlans($term) {
        if (is_numeric($term)) {
            $condition[] = "regExp like '%" . $term . "%'";
        } elseif (substr($term, 0, 1) == '(') {
            $term = str_replace("(","",$term);
            $condition[] = "regExp like '".$term."%'";
        } else {
            $condition[] = "(name.en LIKE '%".str_replace(' ','%',$term)."%' OR name.es LIKE '%".str_replace(' ','%',$term)."%')";
        }
    }
}
