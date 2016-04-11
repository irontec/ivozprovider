<?php

/*
 * Copyright 2011 Piotr Śliwa <peter.pl7@gmail.com>
 *
 * License information is in LICENSE file
 */

namespace Oasis\Template;

class Formatter
{

    public static function format($template, $values)
    {
        $template = self::_procesEaches($template, $values);
        $template = self::_replaceVariables($template, $values);

        return $template;
    }

    protected function _procesEaches($template, $values)
    {
        $pattern = "/({{#([^ ]*) (\w*),(\w*)}})/";
        while (preg_match($pattern, $template, $matches)) {
            $template = self::_procesEach($template, $values, $pattern);
        }
        //echo $template;
        return $template;
    }

    protected function _procesEach($template, $values, $pattern)
    {
        if (preg_match($pattern, $template, $matches)) {
            $targetArray = $matches[2];
            $pattern = "/({{#(".$targetArray.") (\w*),(\w*)}})((?:(?!{{#".$targetArray.").)*)({{\/".$targetArray."}})/s";
            preg_match($pattern, $template, $matches);
            $fullMatch = $matches[0];
            $arrayKey = $matches[2];
            $idKey = $matches[3];
            $valueKey = $matches[4];
            $string = $matches[5];
            $array = self::_getVariableValue($values, $arrayKey);
            $parsedString = "";
            foreach ($array as $id => $value) {
                $targetStr = "{{".$idKey."}}";
                $replacement = $id;
                $tempString = str_replace($targetStr, $replacement, $string);
                $targetStr = "{{".$valueKey;
                $replacement = "{{".$arrayKey.".".$id;
                $tempString = str_replace($targetStr, $replacement, $tempString);
                $targetStr = "{{#".$valueKey;
                $replacement = "{{#".$arrayKey.".".$id;
                $tempString = str_replace($targetStr, $replacement, $tempString);
                $targetStr = "{{/".$valueKey;
                $replacement = "{{/".$arrayKey.".".$id;
                $tempString = str_replace($targetStr, $replacement, $tempString);

                $parsedString .= $tempString;


            }
            $template = str_replace($fullMatch, $parsedString, $template);
            if ($targetArray == "callData.callsPerType") {
                //echo $template; die();
            }
        }

        return $template;
    }

    protected function _replaceVariables($template, $variables, $parentKey = "")
    {
        $pattern = "~({{)((?:(?!{{).)*)(}})~";
        preg_match_all($pattern, $template, $matches);
        foreach ($matches[2] as $key => $searchKey) {
            $searchValue = self::_getVariableValue($variables, $searchKey);
            $template = str_replace($matches[0][$key], $searchValue, $template);
        }
        return $template;
    }

    protected function _getVariableValue($variables, $key)
    {
        $keysArray = explode(".", $key);
        $value = $variables;
        foreach ($keysArray as $key) {
            if (isset($value[$key])) {
                $value = $value[$key];
            } else {
                return null;
            }
        }
        return $value;
    }

}
