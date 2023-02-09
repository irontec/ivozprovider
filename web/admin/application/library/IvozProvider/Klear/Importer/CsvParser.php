<?php

namespace IvozProvider\Klear\Importer;

class CsvParser
{
    protected $_delimiter;
    protected $_enclosure;
    protected $_scape;

    public function __construct($delimiter, $enclosure, $scape)
    {
        $this->_delimiter = $delimiter;
        $this->_enclosure = $enclosure;
        $this->_scape = $scape;
    }

    public function parseFile($filePath, $limit = null)
    {
        $file = file_get_contents($filePath);
        $lines = explode(PHP_EOL, trim($file));

        if (count($lines) <= 0) {
            return false;
        }

        $counter = 0;
        $linesArray = array();
        foreach ($lines as $line) {
            $lineFields = str_getcsv(trim($line), $this->_delimiter, $this->_enclosure, $this->_scape);
            $linesArray[] = $lineFields;
            $counter++;
            if (!is_null($limit) && $counter == $limit) {
                break;
            }
        }

        return $linesArray;
    }
}
