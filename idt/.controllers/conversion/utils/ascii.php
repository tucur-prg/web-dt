<?php
/**
 * ASCII
 */
class Utils_Ascii extends Utils_Abstract implements Utils_Iconvert
{
    protected $name = 'ASCII';
    protected $sortOrder = 20;

    public function convert()
    {
        list($value) = func_get_args();

        $tmp = array();
        for ($i = 0; $i < strlen($value); $i++) {
            $tmp[] = ord($value[$i]);
        }

        return implode(' ', $tmp);
    }
}
