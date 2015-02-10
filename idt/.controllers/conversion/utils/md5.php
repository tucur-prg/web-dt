<?php
/**
 * MD5
 */
class Utils_Md5 extends Utils_Abstract implements Utils_Ihash
{
    protected $name = 'md5';
    protected $sortOrder = 10;

    public function hash()
    {
        list($value) = func_get_args();

        return md5($value);
    }
}
