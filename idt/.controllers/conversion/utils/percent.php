<?php
/**
 * パーセントエンコード
 */
class Utils_Percent extends Utils_Abstract implements Utils_Iconvert
{
    protected $name = '％エンコード';
    protected $sortOrder = 10;

    public function convert()
    {
        list($value) = func_get_args();

        $tmp = array();
        for ($i = 0; $i < strlen($value); $i++) {
            $tmp[] = '%' . bin2hex($value[$i]);
        }

        return implode('', $tmp);
    }
}
