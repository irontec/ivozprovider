<?php

use Ivoz\Core\Application\Service\DataGateway;

require_once '/opt/irontec/klear/modules/klearMatrix/controllers/NewController.php';

class KlearCustomCalendarController extends KlearMatrix_NewController
{
    public function saveAction()
    {
        $mapperName = $this->_item->getMapperName();

        $model = $this->_item->getObjectInstance();

        $this->_helper->log('new::save action for mapper:' . $mapperName);

        $columns = $this->_item->getVisibleColumns();
        $hasDependant = false;

        if ($this->_item->isFilteredScreen()) {
            $filteredField = $this->_item->getFilterField();

            $parentPk = $this->_mainRouter->getParam(
                'parentPk',
                false
            );

            if ($parentPk) {
                $filteredValue = $parentPk;
            } else {
                $filteredValue = $this->_mainRouter->getParam($filteredField);
            }

            $filterFieldSetter = 'set' . ucfirst($filteredField) . 'Id';
            $model->{$filterFieldSetter}($filteredValue);
        }

        $columnNames = array_keys($columns->toArray());
        $targetColumnNames = array_diff(
            $columnNames,
            ['startDate', 'endDate']
        );

        foreach ($columns as $columnName => $column) {
            if (!in_array($columnName, $targetColumnNames)) {
                continue;
            }

            $this->_helper->Column2Model($model, $column);

            $hasDependant = $hasDependant || $column->isDependant();
        }

        $request = $this->getRequest();
        $targetColumn = $columns->getColFromDbName('startDate');

        $startDate = $targetColumn->filterValue(
            $request->getPost('startDate')
        );
        $endDate = $targetColumn->filterValue(
            $request->getPost('endDate')
        );

        try {
            while ($startDate <= $endDate) {
                $model->setEventDate(clone $startDate);
                $this->_save(clone $model, $hasDependant);

                $startDate->add(
                    \DateInterval::createFromDateString('1 day')
                );
            }

            $this->_helper->log(
                'model created succesfully for ' . $mapperName
            );

            $optsString = "";
            if ($this->_item->hasPostActionOptions()) {
                $listLI = array();
                $fieldOpts = $this->_getFieldOptions();
                foreach ($fieldOpts as $opt) {
                    $listLI[] = "<li><span data-id='".$model->getId()."'>".$opt->toAutoOption()."</span></li>";
                }
                if (count($listLI)>0) {
                    $listUL = '<ul class="postActionOptionsListUL ui-state-highlight ui-corner-all">';
                    $listUL.= implode("\n", $listLI) . '</ul>';
                    $optsString = $listUL;
                }
            }

            $data = array(
                'error' => false,
                'pk' => $model->getId(),
                'message' => $this->view->translate('Record successfully saved.') . $optsString
            );
        } catch (\Zend_Exception $exception) {
            $data = array(
                'error' => true,
                'message'=> $exception->getMessage()
            );
            $this->_helper->log(
                'Error saving in new::save for ' . $mapperName . ' ['.$exception->getMessage().']',
                Zend_Log::CRIT
            );
        }

        $jsonResponse = new Klear_Model_SimpleResponse();
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }

    protected function _save($model, $hasDependant)
    {
        try {
            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');
            $dataGateway->persist($this->_item->getEntityClassName(), $model);
        } catch (\Zend_Exception $exception) {
            $displayErrors = ini_get("display_errors");
            $message = $this->view->translate('Error saving record');
            if ($displayErrors) {
                $message.= " (".$exception->getMessage().")";
            }
            throw new \Zend_Exception($message);
        }
    }
}
