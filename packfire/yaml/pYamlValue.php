<?php

/**
 * Provides API for working on YAML values.
 *
 * @author Sam-Mauris Yong / mauris@hotmail.sg
 * @copyright Copyright (c) 2010-2012, Sam-Mauris Yong
 * @license http://www.opensource.org/licenses/bsd-license New BSD License
 * @package packfire.yaml
 * @since 1.0-sofia
 */
class pYamlValue {
    
    /**
     * Strip comments off the text
     * 
     * If the text has multiple lines, the method will remove comments from all
     * the lines.
     * 
     * @param string $line The text to remove comments from.
     * @return string Returns the text without any comments
     * @since 1.0-sofia
     */
    public static function stripComment($line){
        $length = strlen($line);
        $position = 0;
        $escape = false;
        $openQuote = null;
        $start = null;
        $removals = array();
        $doLoop = true;
        while($position < $length && $doLoop){
            switch($line[$position]){
                case '\\':
                    $escape = !$escape;
                    break;
                case "\n":
                    if(!$openQuote && $start !== null){
                        $removals[$start] = $position;
                        $start = null;
                        $position = $length;
                    }
                    break;
                case '#':
                    if($openQuote === null){
                        $start = $position;
                        $position = $length;
                    }
                    break;
                case '"':
                case '\'':
                    if(!$escape){
                        if($openQuote){
                            if($openQuote == $line[$position]){
                                $openQuote = null;
                            }
                        }else{
                            $openQuote = $line[$position];
                            $pos = strpos($line, $line[$position], $position + 1) ;
                            if($pos !== false){
                                $position = $pos - 1;
                            }
                        }
                    }
                default:
                    if($escape){
                        $escape = false;
                    }
                    break;
            }
            ++$position;
        }
        if($start !== null){
            $removals[$start] = $length;
        }
        $offset = 0;
        foreach($removals as $start => $end){
            $start -= $offset;
            $end -= $offset;
            $line = substr($line, 0, $start) . substr($line, $end);
            $offset += ($end - $start);
        }
        return $line;
    }
    
    /**
     * Check whether if text is quoted or not.
     * @param string $text The text to check
     * @return boolean Returns true if the text is quoted, false otherwise. 
     * @since 1.0-sofia
     */
    public static function isQuoted($text){
        $text = trim($text);
        $len = strlen($text);
        return $len > 1 && in_array($text[0], pYamlPart::quotationMarkers()) && $text[0] == $text[$len - 1];
    }
    
    /**
     * Strip quotation marks if the text is wrapped by them.
     * @param string $text The text to strip quotes
     * @return string Returns the processed string
     * @since 1.0-sofia
     */
    public static function stripQuote($text){
        $result = $text;
        if(self::isQuoted($text)){
            $result = substr($text, 1, strlen($text) - 2);
        }
        return $result;
    }
    
    /**
     * Process a scalar value
     * @param string $scalar The value to process
     * @return string Returns the processed scalar value.
     * @since 1.0-sofia
     */
    public static function translateScalar($scalar){
        $result = $scalar;
        $quoted = self::isQuoted($result);
        if(!$quoted || ($quoted && $result[0] != '\'')){
            $result = self::unescape($result);
        }
        if($quoted){
            $result = self::stripQuote($result);
        }
        if(is_string($result)){
            switch(strtolower($scalar)){
                case 'true':
                    $result = true;
                    break;
                case 'false':
                    $result = false;
                    break;
                case 'null':
                    $result = null;
                    break;
            }
        }else if(is_numeric($result)){
            $result += 0;
        }
        return $result;
    }
    
    /**
     * Process and unescape characters from a text
     * @param string $text The text to process
     * @return string Returns the processed text
     * @since 1.0-sofia
     */
    public function unescape($text){
        $replace = array(
            '\n' => "\n",
            '\r' => "\r",
            '\t' => "\t",
            '\0' => "\0",
        );
        $text = str_replace(array_keys($replace), $replace, $text);
        return $text;
    }
    
}