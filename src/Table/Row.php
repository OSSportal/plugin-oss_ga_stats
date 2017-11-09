<?php
namespace Xpressengine\Plugins\OSSGAStats\Table;

class Row
{
    protected $header;

    protected $cols = [];

    public function __construct($header)
    {
        $this->header = $header;
    }

    public function header()
    {
        return $this->header;
    }

    public function addCol(Col $col)
    {
        $this->cols[$col->getColumn()->key()] = $col;
    }

    public function getCol(Column $column)
    {
        return isset($this->cols[$column->key()]) ? $this->cols[$column->key()] : new EmptyCol();
    }
}
