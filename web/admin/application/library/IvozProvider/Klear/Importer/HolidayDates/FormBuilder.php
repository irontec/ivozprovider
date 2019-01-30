<?php

namespace IvozProvider\Klear\Importer\HolidayDates;

use IvozProvider\Klear\Importer\AbstractFormBuilder;

class FormBuilder extends AbstractFormBuilder
{
    /**
     * {@inheritDoc}
     */
    public function getForm(array $lines)
    {
        $form = $this->_styles;

        $help = '<div class="parseHelp"><p><strong>%s</strong></p><br /><p>%s</p><p>%s</p></div><br />';

        $helpLines[] = $this->_translator->translate(
            "Holiday importer system"
        );
        $helpLines[] = $this->_translator->translate(
            "This importer expects values to be within quotation marks and separated by semicolons."
        );
        $helpLines[] = $this->_translator->translate(
            "Ensure the preview below is right before you proceed"
        );
        $help = vsprintf($help, $helpLines);

        $table =  $help . '<div class="tableBox"><table class="kMatrix parsedValues">';
        $table.= "<tr>";

        $name =  $this->_availableFields['name'];
        $eventDate =  $this->_availableFields['eventDate'];

        $nameTranslation = \Klear_Model_Gettext::gettextCheck($name->get('title'));
        $eventDateTranslation = \Klear_Model_Gettext::gettextCheck($eventDate->get('title'));

        $nameValue = '<input type="hidden" name="field_0" value="name" />';
        $eventDateValue = '<input type="hidden" name="field_1" value="eventDate" />';

        $table.="<th class='ui-widget-header multiItem notSortable'>$nameTranslation $nameValue</th>";
        $table.="<th class='ui-widget-header multiItem notSortable'>$eventDateTranslation $eventDateValue</th>";

        $table.= "</tr>";
        foreach ($lines as $line) {
            $table.= "<tr>";
            foreach ($line as $idPart => $part) {
                $table.="<td class='ui-widget-content'>" . $part . "</td>";
            }
            $table.= "</tr>";
        }
        $table .="</table>";
        $form .= $table . '</div><br />';
        $ignoreFirst = $this->_ignoreFirst;
        $checked = '';
        if (!is_null($ignoreFirst) && $ignoreFirst == "on") {
            $checked = 'checked="checked"';
        }
        $form .= '<label><input type="checkbox" name="ingoreFirst" '.$checked.'/> ';
        $form .= $this->_translator->translate("Ignore first line.").'</label>';

        return $form;
    }
}
