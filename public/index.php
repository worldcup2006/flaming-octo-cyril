<?php
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('ROOT')) {
    define('ROOT', __DIR__ . DS . '..' . DS);
}
if (!defined('APPDIR')) {
    define('APPDIR', ROOT . 'application');
}
if (!defined('LIBDIR')) {
    define('LIBDIR', ROOT . 'library');
}
if (!defined('CONFIG')) {
    define('CONFIG', ROOT . 'config' . DS . 'main.php');
}
if (!defined('DEBUG')) {
    define('DEBUG', false);
}
set_include_path(get_include_path() . PATH_SEPARATOR . APPDIR . PATH_SEPARATOR . LIBDIR);
set_exception_handler(array('Minutes\Handler', 'exception'));
function __autoload($className){
    //echo '<b>' . $className . '</b>';
    $className = ltrim($className, '\\');
    $fileName = '';
    $namespace = '';
    if ($lastNsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  .= str_replace('\\', DS, $namespace) . DS;
    }
    $fileName .= str_replace('_', DS, $className) . '.php';
    if (stream_resolve_include_path($fileName)) {
        //echo 'Loading ' . $className . ' from ' . $fileName . '<br/>';
        require $fileName;
    } else {
        if (DEBUG) {
            throw new \Exception('Cannot load class ' . $className . ' from ' .$fileName);
        }
    }
}
$app = Minutes\Application::getInstance();
$app->run(new Minutes\Config\PlainPHP(CONFIG));