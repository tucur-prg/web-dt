<?php
/**
 * ヘッダー制御
 */
class Header
{
    private $statusCode = 200;
    private $headers = array();

    private static $instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function add($key, $value)
    {
        $this->headers[$key] = $value;
        return $this;
    }

    public function setStatusCode($code)
    {
        $this->statusCode = $code;
        return $this;
    }

    public function drop($key)
    {
        unset($this->headers[$key]);
        return $this;
    }

    public function clear()
    {
        $this->headers = array();
        return $this;
    }

    public function get($key)
    {
        return $this->headers[$key];
    }

    public function getAll()
    {
        return $this->headers;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function has($key)
    {
        return isset($this->headers[$key]);
    }
}
