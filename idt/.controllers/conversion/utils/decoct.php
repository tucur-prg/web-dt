<?php
/**
 * decoct
 */
class Utils_Decoct extends Utils_Abstract implements Utils_Iconvert
{
    protected $name = '10進数 → 8進数';
    protected $sortOrder = 50;

    public function convert()
    {
        list($value) = func_get_args();

        return decoct($value);
    }
}
