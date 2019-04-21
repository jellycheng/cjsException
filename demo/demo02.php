<?php
/**
 * Created by PhpStorm.
 * User: jelly
 * Date: 2019-04-21
 * Time: 19:39
 */
require_once __DIR__ . '/common.php';
require_once __DIR__ . '/ServiceException.php';

use App\User\Exception\ServiceException;
ServiceException::initExceptionConfig(include __DIR__ . '/ExceptionCode.php');
ServiceException::initExceptionConfig(include __DIR__ . '/ExceptionCode.php');
ServiceException::appendExceptions(["HELLO_01"=>['hello world', 999]]);


$abc = 60;
$xyz = 2;
try {
    if($abc % $xyz == 0) {
        throw new ServiceException('DATABASE_EXCEPTION');
    }
} catch (ServiceException $e) {
    echo 'code:' . $e->getCode() . PHP_EOL;
    echo 'message: ' . $e->getMessage() . PHP_EOL;
    echo 'errno: ' . $e->getErrno() . PHP_EOL;
}

try {

    throw new ServiceException('HELLO_01');

} catch (ServiceException $e) {
    echo 'code:' . $e->getCode() . PHP_EOL;
    echo 'message: ' . $e->getMessage() . PHP_EOL;
    echo 'errno: ' . $e->getErrno() . PHP_EOL;
}

try {
    //自定义错误代码
    throw new ServiceException('HELLO_01', 888);

} catch (ServiceException $e) {
    echo 'code:' . $e->getCode() . PHP_EOL;
    echo 'message: ' . $e->getMessage() . PHP_EOL;
    echo 'errno: ' . $e->getErrno() . PHP_EOL;
}

try {

    throw new ServiceException('自定义的错误信息', 777);

} catch (ServiceException $e) {
    echo 'code:' . $e->getCode() . PHP_EOL;
    echo 'message: ' . $e->getMessage() . PHP_EOL;
    echo 'errno: ' . $e->getErrno() . PHP_EOL;
}
