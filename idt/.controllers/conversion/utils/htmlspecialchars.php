<?php
/**
 * htmlspecialchars
 */
class Utils_Htmlspecialchars extends Utils_Abstract implements Utils_Iescape
{
    protected $name = 'htmlspecialchars';
    protected $sortOrder = 10;

    public function escape()
    {
        list($value) = func_get_args();

        return htmlspecialchars($value);
    }
}
