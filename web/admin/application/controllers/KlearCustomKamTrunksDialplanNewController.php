<?php

require_once(APPLICATION_PATH . '/../../../../klear/modules/klearMatrix/controllers/NewController.php');

use \Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplan;
use \Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk\TransformationRulesetGroupsTrunk;

class KlearCustomKamTrunksDialplanNewController extends KlearMatrix_NewController
{
    public function saveAction()
    {
        $front = \Zend_Controller_Front::getInstance();
        $screen = $front->getRequest()->getParam("screen");

        $parentField = null;
        switch ($screen) {
            case "kamTrunksDialplan_caller_inNew_screen":
                $parentField = "CallerIn";
                break;
            case "kamTrunksDialplan_caller_outNew_screen":
                $parentField = "CallerOut";
                break;
            case "kamTrunksDialplan_callee_inNew_screen":
                $parentField = "CalleeIn";
                break;
            case "kamTrunksDialplan_callee_outNew_screen":
                $parentField = "CalleeOut";
                break;
        }

        $this->loadValuesFromRequest();

        /**
         * @var \Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanDTO $model
         */
        $model = $this->_item->getObjectInstance();

        if (!is_null($parentField)) {

            $getter =  "get" . $parentField;
            $dataGateway = \Zend_Registry::get('data_gateway');

            /**
             * @var TransformationRulesetGroupsTrunk[] $transformationRulesetGroupsTrunk
             */
            $transformationRulesetGroupsTrunk = $dataGateway->findOneBy(
                TransformationRulesetGroupsTrunk::class,
                [
                    'TransformationRulesetGroupsTrunk.id = :id',
                    ['id' => $model->getTransformationRulesetGroupsTrunkId()]
                ]
            );

            $dpid = !is_null($transformationRulesetGroupsTrunk)
                ? $transformationRulesetGroupsTrunk->{$getter}()
                : null;

            if (is_null($dpid)) {
                /**
                 * @var \Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanDTO[] $maxDpiModels
                 */
                $maxDpiModels = $dataGateway->findBy(
                    TrunksDialplan::class,
                    null,
                    ['TrunksDialplan.dpid' => 'DESC'],
                    1
                );

                if (!empty($maxDpiModels)) {
                    $dpid = $maxDpiModels[0]->getDpid() +1;
                }
            }
            $model->setDpid($dpid);
        }

        $model->setSubstExp(
            $model->getMatchExp()
        );

        return parent::saveAction();
    }

    protected function loadValuesFromRequest()
    {
        /**
         * @var \Ivoz\Kam\Domain\Model\TrunksDialplan\TrunksDialplanDTO $model
         */
        $model = $this->_item->getObjectInstance();

        if ($this->_item->isFilteredScreen()) {

            $filteredField = $this->_item->getFilterField();

            //TODO: Desgaretizar parentPk / parentId :S en todos los controllers --- muy complicado.
            $parentPk = $this->_mainRouter->getParam(
                'parentPk',
                false
            );

            if ($parentPk) {
                //pantalla new desde un edit
                $filteredValue = $parentPk;
            } else {
                $filteredValue = $this->_mainRouter->getParam($filteredField);
            }

            // TODO: Para el screename del parent,
            // recuperar mapper. Hacer fetchById y comprobar
            // que existe el parámetro recibido.

            $filterFieldSetter = 'set' . ucfirst($filteredField);
            $model->{$filterFieldSetter}($filteredValue);
        }

        $columns = $this->_item->getVisibleColumns();
        foreach ($columns as $column) {
            $this->_helper->Column2Model($model, $column);
        }
    }
}

