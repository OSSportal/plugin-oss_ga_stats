<?php
namespace Xpressengine\Plugins\OSSGAStats\Collections;

use ArrayIterator;
use IteratorAggregate;
use Traversable;
use Xpressengine\Plugins\OSSGAStats\Table\Col;
use Xpressengine\Plugins\OSSGAStats\Table\Column;
use Xpressengine\Plugins\OSSGAStats\Table\Row;

class TableCollection implements IteratorAggregate
{
    protected $columns = [];

    protected $rows = [];

    public function __construct($data)
    {
        foreach ($data as $value) {
            list($header, $column, $cnt) = $this->extract($value);
            if (!isset($this->rows[$header])) {
                $this->rows[$header] = new Row($header);
            }
            $this->rows[$header]->addCol(new Col($this->getColumn($column), $cnt));
        }
    }

    protected function extract($value)
    {
        return $value;
    }

    protected function getColumn($name)
    {
        foreach ($this->columns as $column) {
            if ($name == $column->name()) {
                return $column;
            }
        }

        return $this->columns[] = new Column($name);
    }

    public function columns()
    {
        return $this->columns;
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return new ArrayIterator($this->rows);
    }
}
