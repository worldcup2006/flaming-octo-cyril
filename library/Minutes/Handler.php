<?php
namespace Minutes;
class Handler
{
    public static function exception(\Exception $e) {
        echo $e->getMessage();
        echo '<hr/>';
        var_dump($e->getTraceAsString());
    }
    public static function exceptionProduction(\Exception $e) {
        $dest = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . 'exception.log';
        error_log($e->getMessage(), 3, $dest);
        echo 'Sorry, something goes wrong...';
    }
    public static function log($m) {
        $dest = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . 'exception.log';
        error_log($m, 3, $dest);
    }    
}
