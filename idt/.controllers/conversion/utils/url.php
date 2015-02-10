<?php
/**
 * Url
 */
class Utils_Url extends Utils_Abstract implements Utils_Icrypto
{
    protected $name = 'Url';
    protected $sortOrder = 20;

    public function getEncodeName()
    {
        return 'Url Encode';
    }

    public function getDecodeName()
    {
        return 'Url Decode';
    }

    public function encode()
    {
        list($value) = func_get_args();

        return urlencode($value);
    }

    public function decode()
    {
        list($value) = func_get_args();

        return urldecode($value);
    }
}
