<?php
/**
 * sha256
 */
class Utils_Sha256 extends Utils_Abstract implements Utils_Ihash
{
    protected $name = 'sha256';
    protected $sortOrder = 30;

    public function hash()
    {
        list($value) = func_get_args();

        return hash('sha256', $value);
    }
}
