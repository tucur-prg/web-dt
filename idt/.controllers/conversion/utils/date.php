<?php
/**
 * date
 */
class Utils_Date extends Utils_Abstract implements Utils_Iconvert
{
    protected $name = 'PHP Date';
    protected $sortOrder = 120;

    public function convert()
    {
        list($value, $option) = func_get_args();

        if (is_numeric($value) === false) {
            return '';
        }

        if (empty($option) === true) {
            $option = 'Y-m-d H:i:s';
        }

        return date($option, $value);
    }
}
