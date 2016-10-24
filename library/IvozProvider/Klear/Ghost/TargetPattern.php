<?php
class IvozProvider_Klear_Ghost_TargetPattern extends KlearMatrix_Model_Field_Ghost_Abstract {
    
    public function getTargetPattern(\IvozProvider\Model\Raw\PricingPlansRelTargetPatterns $model) {
        if ($model->getTargetPattern() && $model->getTargetPattern()->getName()) {
            return $model->getTargetPattern()->getName().' ('.$model->getTargetPattern()->getRegExp().')';
        }

        return '';
    }

    public function getOrderBy($model) {
        # En esta función también se recibe el $model

        # Devolvemos el valor generado para el ORDER BY
        return "FIELD(campo,".implode(',',valoresOrdenados).")";
    }

    public function getSearchConditionsForItem($values, $searchOps,\IvozProvider\Model\Raw\PricingPlansRelTargetPatterns $model) {
        $conditions = array();
        $condition = array();

        foreach ($values as $term) {
            if (is_numeric($term)) {
                $condition[] = "`regExp` LIKE '%".$term."%'";
            } elseif (substr($term, 0, 1) == '(') {
                $term = str_replace("(","",$term);
                $condition[] = "`regExp` LIKE '".$term."%'";
            } else {
                $condition[] = "`name_en` LIKE '%".str_replace(' ','%',$term)."%'";
                $condition[] = "`name_es` LIKE '%".str_replace(' ','%',$term)."%'";
            }

            $conditions[] = '('.implode(' OR ',$condition).')';
        }

        $mapperTargetPattern = new \IvozProvider\Mapper\Sql\TargetPatterns();

        $targetPatterns = $mapperTargetPattern->fetchList(implode(' AND ',$conditions));

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
            $condition[] = "`regExp` like '%".$term."%'";
        } elseif (substr($term, 0, 1) == '(') {
            $term = str_replace("(","",$term);
            $condition[] = "`regExp` like '".$term."%'";
        } else {
            $condition[] = "(`name_en` LIKE '%".str_replace(' ','%',$term)."%' OR `name_es` LIKE '%".str_replace(' ','%',$term)."%')";
        }
    }
}
