<?php
namespace CjsException;

use Exception;
class BaseException extends Exception
{
    protected static $exceptionConfig = [];
    protected $errno;  //自定义的错误key名

    /**
     *
     * @param $exceptionKey 异常配置key，或者异常信息
     * @param int $exceptionCode 自定义的异常代号
     */
    public function __construct($exceptionKey, $exceptionCode = null)
    {
        $this->errno = $exceptionKey;
        if (isset(self::$exceptionConfig[$exceptionKey])) {
            list($message, $code) = self::$exceptionConfig[$exceptionKey];
            if (!is_null($exceptionCode)) {
                parent::__construct($message, $exceptionCode);
            } else {
                parent::__construct($message, $code);
            }
        } else {
            parent::__construct($exceptionKey, $exceptionCode);
        }
    }

    public static function initExceptionConfig($config) {
        static $isInit = false;
        if($isInit) {
            return '';
        }
        $isInit = true;
        self::appendExceptions($config);
    }

    /**
     * 初始化异常配置 或追加异常配置
     * @param array $config
     */
    public static function appendExceptions($config=[])
    {
        if(is_array($config)) {
            self::$exceptionConfig = array_merge(self::$exceptionConfig, $config);
        } else if($config && file_exists($config)) {
            $tmpConfig = require $config;
            self::$exceptionConfig = array_merge(self::$exceptionConfig, $tmpConfig);
        }
    }

    /*
     *
     */
    public function getErrno($isExceptionCode = false)
    {
        return $isExceptionCode ? $this->getCode() : $this->errno;
    }

    /**
     * @param $code
     * @return bool
     */
    public static function checkCodeKeyExists($code)
    {
        return isset(self::$exceptionConfig[$code]) ? true : false;
    }

    /**
     * @return array
     */
    public static function getExceptionConfig()
    {
        return self::$exceptionConfig;
    }

    /**
     * @param array $exceptionConfig
     */
    public static function setExceptionConfig($exceptionConfig)
    {
        self::$exceptionConfig = $exceptionConfig;
    }

}