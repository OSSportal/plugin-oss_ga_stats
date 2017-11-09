<?php
namespace Xpressengine\Plugins\OSSGAStats\Table;

class Column
{
    protected $name;

    protected $key;

    public function __construct($name)
    {
        $this->name = $name;
        $this->key = hash('sha1', $name);
    }

    public function name()
    {
        return $this->name;
    }

    public function key()
    {
        return $this->key;
    }

    public function __toString()
    {
        return $this->name();
    }
}
