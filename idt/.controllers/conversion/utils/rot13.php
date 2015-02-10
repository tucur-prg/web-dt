<?php
/**
 * str_rot13
 */
class Utils_Rot13 extends Utils_Abstract implements Utils_Iconvert
{
    protected $name = 'rot13';
    protected $sortOrder = 30;

    public function convert()
    {
        list($value) = func_get_args();

        return str_rot13($value);
    }
}
