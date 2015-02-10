<?php
/**
 * dechec
 */
class Utils_Dechex extends Utils_Abstract implements Utils_Iconvert
{
    protected $name = '10進数 → 16進数';
    protected $sortOrder = 60;

    public function convert()
    {
        list($value) = func_get_args();

        return dechex($value);
    }
}
