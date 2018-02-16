<?php

namespace IvozProvider\Klear\Importer;

abstract class AbstractFormBuilder
{
    /**
     * @var array
     */
    protected $_availableFields = [];

    /**
     * @var bool
     */
    protected $_ignoreFirst = false;

    /**
     * @var bool
     */
    protected $_updateValues = false;

    /**
     * @var array
     */
    protected $_postValues = [];

    /**
     * @var \Klear_Controller_Helper_Translate
     */
    protected $_translator;

    protected $_styles = '
        <style>
            .tableBox {
                max-width:750px;overflow:auto;
            }
            .parsedValues tr td {
                border: 1px solid #999;
                padding: 4px;
            }
            .parseHelp {
                padding: 17px;
                font-size: 0.9em;
            }
        </style>
    ';

    public function __construct($availableFields = [], $postValues = [], \Klear_Controller_Helper_Translate $translator)
    {
        if (isset($postValues['ignoreFirst'])) {
            $this->_ignoreFirst = $postValues['ignoreFirst'];
            unset($postValues['ignoreFirst']);
        }

        if (isset($postValues['updateValues'])) {
            $this->_updateValues = $postValues['updateValues'];
            unset($postValues['updateValues']);
        }

        $this->_availableFields = $availableFields;
        $this->_postValues = $postValues;
        $this->_translator = $translator;
    }

    /**
     * @param array $lines
     * @return string
     */
    abstract public function getForm(array $lines);
}
