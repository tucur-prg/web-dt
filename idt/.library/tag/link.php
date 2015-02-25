<?php
/**
 * Link制御
 */
class Tag_Link
{
    private $links = array();

    private static $capture = false;
    private static $instance;

    private function __construct()
    {
    }

    public function __toString()
    {
        $html = '';
        foreach ($this->links as $link) {
            $html .= "<link rel=\"{$link['rel']}\" href=\"{$link['href']}\">\n";
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

    public function addStylesheet($href)
    {
        $this->links[] = array('rel' => 'stylesheet', 'href' => $href);
        return $this;
    }

    public function add($attribute)
    {
        $this->links[] = $attribute;
        return $this;
    }

    public function clear()
    {
        $this->links = array();
        return $this;
    }
}
