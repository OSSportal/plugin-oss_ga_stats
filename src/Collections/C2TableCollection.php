<?php
namespace Xpressengine\Plugins\OSSGAStats\Collections;

class C2TableCollection extends TableCollection
{
    protected function extract($value)
    {
        list($header, $item, $version, $cnt) = $value;
        $column = $item . '(' . $version . ')';

        return [$header, $column, $cnt];
    }
}
