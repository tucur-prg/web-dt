<?php
/**
 * PlainText Json Web Token
 */
class Utils_Ptjwt extends Utils_Abstract implements Utils_Icrypto
{
    protected $name = 'PT JWT';
    protected $sortOrder = 60;

    public function getEncodeName()
    {
        return 'PT JWT Encode';
    }

    public function getDecodeName()
    {
        return 'PT JWT Decode';
    }

    public function encode()
    {
        list($value, $key) = func_get_args();

        try {
            $value = JWT::encode($this->convert($value, 'eval'), $key, 'none');
        } catch (\Exception $e) {
            $value = $e->getMessage();
        }

        return $value;
    }

    public function decode()
    {
        list($value, $key) = func_get_args();

        try {
            $value = JWT::decode($value, $key, false);
        } catch (\Exception $e) {
            $value = $e->getMessage();
        }

        return var_export($value, true);
    }
}
