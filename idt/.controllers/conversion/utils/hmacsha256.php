<?php
/**
 * hmac sha256
 */
class Utils_Hmacsha256 extends Utils_Abstract implements Utils_Ihash
{
    protected $name = 'hmac_sha256';
    protected $sortOrder = 50;

    public function hash()
    {
        list($value, $key) = func_get_args();

        return hash_hmac('sha256', $value, $key);
    }
}
