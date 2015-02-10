<?php
/**
 * Script制御
 */
class Tag_Script
{
    private $scripts = array();

    private static $capture = false;
    private static $instance;

    private function __construct()
    {
    }

    public function __toString()
    {
        $html = '';
        foreach ($this->scripts as $script) {
            $html .= "<script src=\"{$script['src']}\"></script>\n";
        }

        return $html;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function addFile($src)
    {
        $this->scripts[] = array('src' => $src);
        return $this;
    }

    public function clear()
    {
        $this->scripts = array();
        return $this;
    }
}
