<?php
/**
 * sha512
 */
class Utils_Sha512 extends Utils_Abstract implements Utils_Ihash
{
    protected $name = 'sha512';
    protected $sortOrder = 40;

    public function hash()
    {
        list($value) = func_get_args();

        return hash('sha512', $value);
    }
}
