<?php
/**
 * ビュー制御
 */
class View
{
    private $dir        = '';
    private $controller = '';

    public function setDir($dir)
    {
        $this->dir = rtrim($dir, '/');
    }

    public function setController($controller)
    {
        $this->controller = $controller;
    }

    public function readContent()
    {
        ob_start();

        $file = "{$this->dir}/{$this->controller}.html";
        if (file_exists($file)) {
            include $file;
        }

        return ob_get_clean();
    }

    public function readScript()
    {
        $file = "{$this->dir}/{$this->controller}.js";
        if (file_exists($file)) {
            $html = "<script>\n".trim(file_get_contents($file), "\n")."\n</script>\n";
        }

        return $html;
    }

    public function readStyle()
    {
        $file = "{$this->dir}/{$this->controller}.css";
        if (file_exists($file)) {
            $html = "<style>\n".trim(file_get_contents($file), "\n")."\n</style>\n";
        }

        return $html;
    }

    public function escape($value)
    {
        return htmlspecialchars($value);
    }

    public function arrayToHtml($array)
    {
        if (is_array($array) === false) {
            return '';
        }

        $html = '<table class="block-line">';

        foreach ($array as $key => $value) {
            $keyTag = '<th>'.$this->escape($key).'</th>';

            if (is_array($value)) {
                $valueTag = $this->arrayToHtml($value);
            } else {
                $valueTag = '<td>'.$this->escape($value).'</td>';
            }

            $html .= '<tr>'.$keyTag.$valueTag.'</tr>'."\n";
        }

        $html .= '</table>';

        return $html;
    }
}
