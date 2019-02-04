<?php

use IvozProvider\Klear\Importer\ImporterControllerTrait;
use IvozProvider\Klear\Importer\HolidayDates\FormBuilder as HolidayDatesFormBuilder;

class ImportFileController extends Zend_Controller_Action
{
    use ImporterControllerTrait;

    public function importAction()
    {
        $this->_helper->ContextSwitch()
            ->addActionContext("import", "json")
            ->initContext("json");

        switch ($this->getParam("step")) {
            case "process_confirm":
                $this->_import();
                break;
            case "load_file":
                if (is_null($this->_getFilePath())) {
                    $this->_loadFile();
                } else {
                    $this->_confirmImport();
                }
                break;
            default:
                $this->_loadFile();
                break;
        }
    }

    public function importHolidayDatesAction()
    {
        $this->_helper
            ->ContextSwitch()
            ->addActionContext("import-holiday-dates", "json")
            ->initContext("json");

        $selectableFields = array_diff_key($this->_availableFields, $this->_forcedValues);
        $this->_customFormBuilder = new HolidayDatesFormBuilder(
            $selectableFields,
            $this->_getFilteredPostValues(),
            $this->_helper->translate
        );

        switch ($this->getParam("step")) {
            case "process_confirm":
                $this->_import();
                break;
            case "load_file":
                if (is_null($this->_getFilePath())) {
                    $this->_loadFile();
                } else {
                    $this->_confirmImport();
                }
                break;
            default:
                $helpMessages[] = $this->_helper->translate(
                    "This importer expects values to be within quotation marks and separated by semicolons."
                );

                $helpMessages[] = $this->_helper->translate(
                    "For instance:"
                );
                $helpMessage = vsprintf('<p>%s %s</p>', $helpMessages);

                $examples[] = '"Christmas eve";"2018-12-24"';
                $examples[] = '"New year\'s day";"2019-01-01"';
                $example = vsprintf('<pre style="margin:10px 0;"><p>%s</p><p>%s</p></pre>', $examples);

                $this->_loadFile('<div style="max-width:400px;">' . $helpMessage . $example . '</div><br />');
                break;
        }
    }
}
