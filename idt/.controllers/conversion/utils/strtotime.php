<?php
/**
 * strtotime
 */
class Utils_Strtotime extends Utils_Abstract implements Utils_Iconvert
{
    protected $name = 'PHP StrToTime';
    protected $sortOrder = 110;

    public function convert()
    {
        list($value) = func_get_args();

        return strtotime($value);
    }
}
