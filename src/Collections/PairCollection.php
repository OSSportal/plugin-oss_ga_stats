<?php
namespace Xpressengine\Plugins\OSSGAStats\Collections;

class PairCollection extends TableCollection
{
    protected function extract($value)
    {
        list($header, $cnt) = $value;

        return [$header, 'Count', $cnt];
    }
}