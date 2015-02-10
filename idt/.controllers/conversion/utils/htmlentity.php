<?php
/**
 * HTML Entity
 */
class Utils_Htmlentity extends Utils_Abstract implements Utils_Icrypto
{
    protected $name = 'HTML Entity';
    protected $sortOrder = 100;

    public function getEncodeName()
    {
        return 'htmlentities';
    }

    public function getDecodeName()
    {
        return 'html_entity_decode';
    }

    public function encode()
    {
        list($value) = func_get_args();

        return htmlentities($value);
    }

    public function decode()
    {
        list($value) = func_get_args();

        return html_entity_decode($value);
    }
}
