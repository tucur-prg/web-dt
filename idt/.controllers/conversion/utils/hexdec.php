<?php
/**
 * hexdec
 */
class Utils_Hexdec extends Utils_Abstract implements Utils_Iconvert
{
    protected $name = '16進数 → 10進数';
    protected $sortOrder = 90;

    public function convert()
    {
        list($value) = func_get_args();

        return hexdec($value);
    }
}
