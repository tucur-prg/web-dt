<?php
/**
 * bindec
 */
class Utils_Bindec extends Utils_Abstract implements Utils_Iconvert
{
    protected $name = '2進数 → 10進数';
    protected $sortOrder = 70;

    public function convert()
    {
        list($value) = func_get_args();

        return bindec($value);
    }
}
