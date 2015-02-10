<?php
/**
 * strlen 文字の長さ
 */
class Utils_Strlen extends Utils_Abstract implements Utils_Iconvert
{
    protected $name = '文字数';
    protected $sortOrder = 100;

    public function convert()
    {
        list($value) = func_get_args();

        return strlen($value);
    }
}
