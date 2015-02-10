<?php
/**
 * Base64
 */
class Utils_Base64 extends Utils_Abstract implements Utils_Icrypto
{
    protected $name = 'Base64';
    protected $sortOrder = 10;

    public function getEncodeName()
    {
        return 'Base64 Encode';
    }

    public function getDecodeName()
    {
        return 'Base64 Decode';
    }

    public function encode()
    {
        list($value) = func_get_args();

        return base64_encode($value);
    }

    public function decode()
    {
        list($value) = func_get_args();

        return base64_decode($value);
    }
}
