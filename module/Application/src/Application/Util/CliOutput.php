<?php
namespace Application\Util;

/**
 * 
 * @author Athlan
 *
 */
trait CliOutput
{
    public function _print($str) {
        echo $str;
    }
    
    public function _printLine($str = null) {
        echo $str . PHP_EOL;
    }
}
