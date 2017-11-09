<?php

namespace Xpressengine\Plugins\OSSGAStats;

use Xpressengine\Skin\AbstractSkin;

class StatsSkin extends AbstractSkin
{
    public function render()
    {
        return view('oss_ga_stats::views.' . $this->view, $this->data);
    }
}
