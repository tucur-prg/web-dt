<?php
/**
 * PHP Serialize
 */
class Utils_Phpserialize extends Utils_Abstract implements Utils_Icrypto
{
    protected $name = 'PHP Serialize';
    protected $sortOrder = 30;

    public function getEncodeName()
    {
        return 'PHP Serialize';
    }

    public function getDecodeName()
    {
        return 'PHP Unserialize';
    }

    public function encode()
    {
        list($value) = func_get_args();

        return serialize($this->convert($value, 'eval'));
    }

    public function decode()
    {
        list($value) = func_get_args();

        return var_export(@unserialize($value), true);
    }
}
