<?php
/**
 * hmac sha512
 */
class Utils_Hmacsha512 extends Utils_Abstract implements Utils_Ihash
{
    protected $name = 'hmac_sha512';
    protected $sortOrder = 60;

    public function hash()
    {
        list($value, $key) = func_get_args();

        return hash_hmac('sha512', $value, $key);
    }
}
