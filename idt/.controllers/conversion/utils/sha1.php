<?php
/**
 * sha1
 */
class Utils_Sha1 extends Utils_Abstract implements Utils_Ihash
{
    protected $name = 'sha1';
    protected $sortOrder = 20;

    public function hash()
    {
        list($value) = func_get_args();

        return sha1($value);
    }
}
