<?php
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2019-04-21
 * Time: 19:39
 */
require_once __DIR__ . '/common.php';


\CjsException\BaseException::initExceptionConfig(include __DIR__ . '/ExceptionCode.php');
\CjsException\BaseException::initExceptionConfig(include __DIR__ . '/ExceptionCode.php');
\CjsException\BaseException::appendExceptions(["HELLO_01"=>['hello world', 999]]);

var_export(\CjsException\BaseException::getExceptionConfig());
echo PHP_EOL;
var_dump(\CjsException\BaseException::checkCodeKeyExists('RPC_SERVICE_ERROR'));
echo PHP_EOL;
var_dump(\CjsException\BaseException::checkCodeKeyExists('RPC_SERVICE_ERROR123'));
echo PHP_EOL;

$abc = 60;
$xyz = 2;
try {
    if($abc % $xyz == 0) {
        throw new \CjsException\BaseException('DATABASE_EXCEPTION');
    }
} catch (\CjsException\BaseException $e) {
    echo 'code:' . $e->getCode() . PHP_EOL;
    echo 'message: ' . $e->getMessage() . PHP_EOL;
    echo 'errno: ' . $e->getErrno() . PHP_EOL;
}

