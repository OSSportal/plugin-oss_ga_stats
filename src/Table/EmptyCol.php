<?php
namespace Xpressengine\Plugins\OSSGAStats\Table;

class EmptyCol implements ColInterface
{
    public function value()
    {
        return 0;
    }
}
