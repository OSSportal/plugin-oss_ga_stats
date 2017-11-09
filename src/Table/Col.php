<?php
namespace Xpressengine\Plugins\OSSGAStats\Table;


class Col implements ColInterface
{
    protected $column;
    protected $cnt;

    public function __construct(Column $column, $cnt)
    {
        $this->column = $column;
        $this->cnt = $cnt;
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function value()
    {
        return $this->cnt;
    }
}
