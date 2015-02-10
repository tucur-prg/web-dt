<?php
/**
 * Utilsコンテナ
 */
class Container_Utils implements Iterator
{
    private $isSort = false;

    private $position = 0;
    private $stock    = array();

    public function __construct()
    {
        $this->position = 0;
    }

    public function rewind()
    {
        $this->sort();
        $this->position = 0;
    }

    public function current()
    {
        $this->sort();
        return $this->stock[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->stock[$this->position]);
    }

    public function add(Utils_Abstract $instance)
    {
        $this->isSort = false;
        $this->stock[] = $instance;
    }

    protected function sort()
    {
        if ($this->isSort === false) {
            $this->isSort = true;

            usort($this->stock, function ($l, $r) {
                if ($l->getSortOrder() == $r->getSortOrder()) {
                    return 0;
                }

                return ($l->getSortOrder() < $r->getSortOrder()) ? -1 : 1;
            });
        }
    }
}
