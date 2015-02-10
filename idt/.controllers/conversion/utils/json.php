<?php
/**
 * Json
 */
class Utils_Json extends Utils_Abstract implements Utils_Icrypto
{
    protected $name = 'Json';
    protected $sortOrder = 40;

    public function getEncodeName()
    {
        return 'Json Encode';
    }

    public function getDecodeName()
    {
        return 'Json Decode';
    }

    public function encode()
    {
        list($value) = func_get_args();

        return json_encode($this->convert($value, 'eval'));
    }

    public function decode()
    {
        list($value) = func_get_args();

        return var_export(json_decode($value), true);
    }
}
