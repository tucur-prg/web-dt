<?php
/**
 * decbin
 */
class Utils_Decbin extends Utils_Abstract implements Utils_Iconvert
{
    protected $name = '10進数 → 2進数';
    protected $sortOrder = 40;

    public function convert()
    {
        list($value) = func_get_args();

        return decbin($value);
    }
}
