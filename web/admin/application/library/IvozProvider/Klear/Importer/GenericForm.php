<?php

namespace IvozProvider\Klear\Importer;

class GenericForm extends AbstractFormBuilder
{
    /**
     * {@inheritDoc}
     */
    public function getForm(array $lines)
    {
        $form = $this->_styles;

        $help = '<div class="parseHelp">';
        $help.= '<p>'.$this->_translator->translate("Import file").";
        $help.= ".$this->_translator->translate("Set column configuration and continue.").'</p>';
        $help.= '<p>'.$this->_translator->translate("Fields with * are required").'.</p><br/>';
        $help.= '<ul style="max-height: 150px; overflow-y: auto;">';

        foreach ($this->_availableFields as $key => $fieldInfo) {
            $fieldLabel = \Klear_Model_Gettext::gettextCheck($fieldInfo->get('title'));
            $required = "";
            if (!is_null($fieldInfo->get('required')) && $fieldInfo->get('required')) {
                $required = "*";
            }
            $fieldHelp = "";
            if (!is_null($fieldInfo->get('help'))) {
                $required .= ": ";
                $fieldHelp = \Klear_Model_Gettext::gettextCheck($fieldInfo->get('help'));
            }

            $help.='<li>'.$fieldLabel.$required.'<em>'.$fieldHelp.'</em></li>';
        }

        $help.= '</ul></div>';
        $table = $help . '<div class="tableBox"><table class="kMatrix parsedValues">';
        $table.= "<tr>";
        $idx = 0;

        $lineLength = count($lines[0]);
        $availableFieldsKeys = array_keys($this->_availableFields);

        $fieldValues = $this->_postValues;

        for ($i = 0; $i < $lineLength; $i ++) {
            $optionValue = isset($fieldValues['field_'.$i]) ? $fieldValues['field_'.$i] : null;

            $tmp = '<select name="field_'. $i;
            $tmp .= '" class="notcombo visualFilter ui-widget ui-state-default ui-corner-all ui-state-valid">';
            $selected = "";
            if ($optionValue == "ignore") {
                $selected = 'selected="selected"';
            }
            $tmp .= '<option value="ignore" ' . $selected . '>';
            $tmp .= $this->_translator->translate('ignore');
            $tmp .= '</option>';

            $fields = [];
            foreach ($availableFieldsKeys as $idf => $xfield) {
                $xfieldLabel = $xfield;
                $xfieldRequired = "";
                if ($this->_availableFields[$xfield]->get('required')) {
                    $xfieldRequired = "*";
                }
                $selected = "";
                if (is_null($optionValue) && $i == $idf) {
                    $selected = 'selected="selected"';
                } else {
                    if ($optionValue == $xfield) {
                        $selected = 'selected="selected"';
                    }
                }

                $fields[$xfield] = '<option value="' . $xfield . '" '
                    . $selected . '>'
                    . $xfieldLabel . $xfieldRequired
                    . '</option>';
            }

            uasort($fields, function ($str1, $str2) {

                $str1 = strtolower($str1);
                $str2 = strtolower($str2);
                if ($str1 == $str2) {
                    return 0;
                }
                return ($str1 < $str2) ? -1 : 1;
            });

            $tmp .= implode($fields) . '</select>';
            $table .= "<th class='ui-widget-header multiItem notSortable'>" . $tmp . "</th>";
        }

        $table.= "</tr>";
        foreach ($lines as $line) {
            $table .= "<tr>";
            foreach ($line as $idPart => $part) {
                $table .= "<td class='ui-widget-content'>" . $part . "</td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table>";
        $form .= $table . '</div><br />';
        $ignoreFirst = $this->_ignoreFirst;
        $checked = '';
        if (!is_null($ignoreFirst) && $ignoreFirst == "on") {
            $checked = 'checked="checked"';
        }
        $form .= '<label><input type="checkbox" name="ingoreFirst" '.$checked.'/> ';
        $form .= $this->_translator->translate("Ignore first line.") . '</label>';

        $update = $this->_updateValues;
        $checked = '';
        if ($update == "on") {
            $checked = 'checked="checked"';
        }

        $form .= '<label><input type="checkbox" name="update" ' . $checked . '/> ';
        $form .= $this->_translator->translate("Update values.") . '</label>';

        return $form;
    }
}
