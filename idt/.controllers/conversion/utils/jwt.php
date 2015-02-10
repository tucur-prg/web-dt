<?php
/**
 * Json Web Token
 */
class Utils_Jwt extends Utils_Abstract implements Utils_Icrypto
{
    protected $name = 'JWT';
    protected $sortOrder = 50;

    public function getEncodeName()
    {
        return 'JWT Encode';
    }

    public function getDecodeName()
    {
        return 'JWT Decode';
    }

    public function encode()
    {
        list($value, $key) = func_get_args();

        try {
            $value = JWT::encode($this->convert($value, 'eval'), $key);
        } catch (\Exception $e) {
            $value = $e->getMessage();
        }

        return $value;
    }

    public function decode()
    {
        list($value, $key) = func_get_args();

        try {
            $value = JWT::decode($value, $key);
        } catch (\Exception $e) {
            $value = $e->getMessage();
        }

        return var_export($value, true);
    }
}
