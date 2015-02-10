<?php
/**
 * octdec
 */
class Utils_Octdec extends Utils_Abstract implements Utils_Iconvert
{
    protected $name = '8進数 → 10進数';
    protected $sortOrder = 80;

    public function convert()
    {
        list($value) = func_get_args();

        return octdec($value);
    }
}
