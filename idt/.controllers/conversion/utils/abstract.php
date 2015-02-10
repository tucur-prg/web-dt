<?php
/**
 * 暗号/複合 抽象クラス
 */
class Utils_Abstract
{
    /**
     * 表示名
     *
     * @var string
     */
    protected $name = '';

    /**
     * 並び順
     *
     * @var integer
     */
    protected $sortOrder = 0;

    public function getViewName()
    {
        return $this->name;
    }

    public function getSortOrder()
    {
        return (int) $this->sortOrder;
    }

    public function convert($value, $type)
    {
        switch ($type) {
            case 'eval':
                if (strpos($value, 'array(') === 0) {
                    $value = rtrim($value, ';');
                    eval("\$value = {$value};");
                }
                break;

            case 'int':
                $value = (int) $value;
                break;

            default:
                break;
        }

        return $value;
    }
}
