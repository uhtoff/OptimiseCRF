<?php
function errorHandler($errno, $errstr, $errfile, $errline) {
    static $db;
    if (empty($db)) {
        DB::setDB('error', 'error', 'error');
    }
    $sql = "INSERT INTO errorLog (severity, message, filename, lineno, time) 
        VALUES (?, ?, ?, ?, NOW())";
    switch ($errno) {
        case E_NOTICE:
        case E_USER_NOTICE:
        case E_DEPRECATED:
        case E_USER_DEPRECATED:
        case E_STRICT:
            $pA = array('sssi', "NOTICE", $errstr, $errfile, $errline);
            DB::query($sql,$pA);
            break;
        case E_WARNING:
        case E_USER_WARNING:
            $pA = array('sssi', "WARNING", $errstr, $errfile, $errline);
            DB::query($sql, $pA);
            break;
        case E_ERROR:
        case E_USER_ERROR:
            $pA = array('sssi', "FATAL", $errstr, $errfile, $errline);
            DB::query($sql, $pA);
            exit("FATAL error $errstr at $errfile:$errline");
        default:
            exit("Unknown error at $errfile:$errline");
    }
    return false;
}
function loadClass( $class ) {
    if ( $class != 'PasswordLib\PasswordLib') {
        require_once( $class . '.php' );
    }
}
function addIncludePath( $path ) {
    if ( php_sapi_name() === 'cli' ) {
        $root = '.';
    } else {
        $root = $_SERVER['DOCUMENT_ROOT'];
    }
    $path = $root . $path;

    set_include_path(get_include_path() . PATH_SEPARATOR . $path);
}
//set_error_handler("errorHandler");
addIncludePath('/libs');
addIncludePath('/classes');
addIncludePath('/addons');
spl_autoload_register( 'loadClass' );
date_default_timezone_set( 'Europe/London' );
ini_set('default_charset', 'UTF-8');
ini_set('error_reporting', E_ALL | E_STRICT);
ini_set('display_errors', true ); # Change error display when move to prod
mb_internal_encoding('utf-8');